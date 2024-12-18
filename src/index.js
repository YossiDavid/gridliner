jQuery( window ).on( 'elementor/frontend/init', function() {
	const init = () => {
		// Function to create the canvas element
		let html = document.documentElement
		let body = document.body

		const hexToRGB = ( hex, alpha ) => {

			const r = parseInt( hex.slice( 1, 3 ), 16 );
			const g = parseInt( hex.slice( 3, 5 ), 16 );
			const b = parseInt( hex.slice( 5, 7 ), 16 );

			if ( alpha ) {
				return `rgba(${ r }, ${ g }, ${ b }, ${ alpha })`;
			}

			return `rgb(${ r }, ${ g }, ${ b })`;
		}

		const createCanvas = () => {
			let canvas = document.createElement( "canvas" )
			canvas.id = "styliner-grid-system"
			body.appendChild( canvas )
		}

		// Grid drawing function with dynamic colors
		const grid = () => {
			if ( elementor.settings.editorPreferences.model.attributes.styliner_grid !== 'yes' ) {
				return
			}



			let columns = 53
			let bigColumns = 12
			let oneColumn = 3

			let gColor = ( elementor.settings.editorPreferences.model.attributes.styliner_grid_color ) ?
				hexToRGB( elementor.settings.editorPreferences.model.attributes.styliner_grid_color, 0.5 ) :
				"rgba(255, 0, 0, 0.15)";

			// Default colors
			let gridColor = gColor
			let columnsColor = gColor
			let rowsColor = gColor
			let width = html.clientWidth
			let height = html.offsetHeight

			let columnsWidth = width / columns
			let rows = height / columnsWidth
			let bigColumnWidth = ( width / columns ) * oneColumn
			let gap = 1
			let bigRows = height / ( bigColumnWidth + gap )
			let canvas = document.querySelector( "#styliner-grid-system" )
			canvas.width = width
			canvas.height = height

			let c = canvas.getContext( "2d" )

			// Grid
			for ( let i = 1; i < columns; i ++ ) {
				c.beginPath()
				c.moveTo( columnsWidth * i, 0 )
				c.lineTo( columnsWidth * i, height )
				c.strokeStyle = gridColor // Use dynamic color
				c.stroke()
			}

			for ( let i = 1; i < rows; i ++ ) {
				c.beginPath()
				c.moveTo( 0, columnsWidth * i )
				c.lineTo( width, columnsWidth * i )
				c.strokeStyle = gridColor // Use dynamic color
				c.stroke()
			}

			// Columns
			for ( let i = 1; i <= bigColumns; i ++ ) {
				c.fillStyle = columnsColor // Use dynamic color
				let x = bigColumnWidth + bigColumnWidth / 3
				c.fillRect( x * i - bigColumnWidth / 3, 0, bigColumnWidth, height )
			}

			// Rows
			for ( let i = 1; i <= bigRows; i ++ ) {
				c.fillStyle = rowsColor // Use dynamic color
				let x = bigColumnWidth + bigColumnWidth / 3
				c.fillRect( 0, x * i - bigColumnWidth / 3, width, bigColumnWidth )
			}
		}

		createCanvas()
		grid()

		// Attach resize and scroll events
		document.onscroll = () => grid()
		window.onresize = () => grid()
		// ResizeObserver to handle updates
		const resizeObserver = new ResizeObserver( ( entries ) => grid() )

		// add custom event listener to update grid on elementor panel changes
		window.addEventListener( 'stylinerGridUpdate', () => grid() );
	}
	init();
} );

