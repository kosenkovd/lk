var map;
jQuery(document).ready(function(){

    map = new GMaps({
        div: '#map',
        lat: 59.927742,
        lng: 30.374592,
    });
    map.addMarker({
        lat: 59.927742,
        lng: 30.374592,
        title: 'Address',      
        infoWindow: {
            content: '<h5 class="title">College Green</h5><p><span class="region">Address line goes here</span><br><span class="postal-code">Postcode</span><br><span class="country-name">Country</span></p>'
        }
        
    });

});