window.addEventListener("DOMContentLoaded", () => {
	console.log(elementor)
	const preferences = elementor.settings.editorPreferences
	console.log(preferences)
	console.log(preferences.getSettings())
	console.log(preferences.getEditedView())
	console.log(preferences.getDataToSave())
	console.log(preferences.on())
	preferences.on("update", () => console.log(preferences.getSettings()))

	preferences.on("change:styliner_grid", (_, value) => {
		const canvas = ensureCanvas()
		canvas.style.display = value === "yes" ? "block" : "none"
	})

	window.top.addEventListener("elementor/commands/run/after", console.log(e))
})
