document.addEventListener("DOMContentLoaded", () => {
	let html = document.documentElement
	let body = document.body

	let columns = 53
	let bigColumns = 12
	let oneColumn = 3

	// Default colors
	let gridColor = "rgba(255, 0, 0, 0.15)"
	let columnsColor = "rgba(255, 0, 0, 0.15)"
	let rowsColor = "rgba(255, 0, 0, 0.15)"

	// Function to create the canvas element
	const createCanvas = () => {
		let canvas = document.createElement("canvas")
		canvas.id = "styliner-grid-system"
		body.appendChild(canvas)
	}

	// Grid drawing function with dynamic colors
	const grid = () => {
		let width = html.clientWidth
		let height = html.offsetHeight

		let columnsWidth = width / columns
		let rows = height / columnsWidth
		let bigColumnWidth = (width / columns) * oneColumn
		let gap = 1
		let bigRows = height / (bigColumnWidth + gap)
		let canvas = document.querySelector("#styliner-grid-system")
		canvas.width = width
		canvas.height = height

		let c = canvas.getContext("2d")

		// Grid
		for (let i = 1; i < columns; i++) {
			c.beginPath()
			c.moveTo(columnsWidth * i, 0)
			c.lineTo(columnsWidth * i, height)
			c.strokeStyle = gridColor // Use dynamic color
			c.stroke()
		}

		for (let i = 1; i < rows; i++) {
			c.beginPath()
			c.moveTo(0, columnsWidth * i)
			c.lineTo(width, columnsWidth * i)
			c.strokeStyle = gridColor // Use dynamic color
			c.stroke()
		}

		// Columns
		for (let i = 1; i <= bigColumns; i++) {
			c.fillStyle = columnsColor // Use dynamic color
			let x = bigColumnWidth + bigColumnWidth / 3
			c.fillRect(x * i - bigColumnWidth / 3, 0, bigColumnWidth, height)
		}

		// Rows
		for (let i = 1; i <= bigRows; i++) {
			c.fillStyle = rowsColor // Use dynamic color
			let x = bigColumnWidth + bigColumnWidth / 3
			c.fillRect(0, x * i - bigColumnWidth / 3, width, bigColumnWidth)
		}
	}

	createCanvas()
	grid()

	// Attach resize and scroll events
	document.onscroll = () => grid()
	window.onresize = () => grid()

	// Example: Dynamically update colors (this would come from your Elementor controls)
	// window.updateGridColors = updateColors // Expose the update function globally
})

// ResizeObserver to handle updates
const resizeObserver = new ResizeObserver((entries) => grid())
