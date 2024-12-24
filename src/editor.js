jQuery(window).on("elementor:init", () => {
	// On "document:loaded" elementor event
	elementor.on("document:loaded", () => {
		const updateGridEvent = new Event("stylinerGridUpdate")
		elementor.settings.editorPreferences.model.on("change", (view) => {
			let shouldDraw = false
			for (let setting in view.changed) {
				// only listen to our controls
				if (
					![
						"styliner_grid",
						"styliner_grid_color",
						"styliner_columns_color",
						"styliner_rows_color",
					].includes(setting)
				) {
					continue
				}

				shouldDraw = true
			}

			if (shouldDraw) {
				elementor.$preview[0].contentWindow.dispatchEvent(
					updateGridEvent
				)
			}
		})
	})
})
