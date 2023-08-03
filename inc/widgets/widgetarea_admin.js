jQuery(function() {
	let observer = createObserver();

	// Enum widget areas to update and observe each area.
	document.querySelectorAll("#widgets-right .widgets-holder-wrap .widgets-sortables").forEach((node) => {
		updateTitle(node.querySelector(".sidebar-name h2"), countWidgets(node));

		observer.observe(node, {"childList":true});
	});

	/**
	 * Create an observer to observe child nodes change and update the title.
	 */
	function createObserver()
	{

		return new MutationObserver((mutationsList, observer) => {
			for (const mutation of mutationsList) {
				if (mutation.addedNodes.length > 0 && mutation.target.classList.contains("widget"))
				{
					// A widget added
					updateTitle(mutation.target.querySelector(".sidebar-name h2"), countWidgets(mutation.target));
				}
				else if (mutation.removedNodes.length > 0 && mutation.removedNodes[0].classList.contains("widget"))
				{
					// A widget removed
					updateTitle(mutation.target.querySelector(".sidebar-name h2"), countWidgets(mutation.target));
				}
			}
		});

	}

	/**
	 * Update the title with the count given.
	 *
 	 * @param	{HTMLElement}	node				HTMLElement to update.
 	 * @param	{Number}		count				Widgets count.
	 */
	function updateTitle(node, count)
	{

		let textNode = node.childNodes[0];
		let pos = textNode.data.lastIndexOf("(");
		let title = ( pos > -1 ? textNode.data.substring(0, pos - 1) : textNode.data ) + " (" + count + ")";

		textNode.data = title;

	}

	/**
	 * Count the number of widgets.
	 *
 	 * @param	{HTMLElement}	rootNode			Root node of widgets.
	 */
	function countWidgets(rootNode)
	{

		return rootNode.querySelectorAll(".widget").length;

	}
});
