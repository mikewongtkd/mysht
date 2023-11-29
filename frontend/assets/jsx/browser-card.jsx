class BrowserCardTemplate {
	static singleton = null;
	constructor() {
		if( BrowserCard::singleton !== null ) {
			return BrowserCard::singleton;
		}

		this.template = $( '#browser-card-template' ).detach().children().first();
	}

	render( row ) {
	}
}
