function initMap() {
  const exploreMaps = document.querySelectorAll('.explore-locations'),
    exploreMapsLength = exploreMaps.length;
  for (let i = 0; i < exploreMapsLength; i++) {
    const currentMap = exploreMaps[i].querySelector(
      '.explore-locations-canvas'
    );
    mapboxgl.accessToken = currentMap.getAttribute('data-key');
    const map = new mapboxgl.Map({
        container: currentMap.getAttribute('id'),
        style: 'mapbox://styles/mapbox/light-v10?optimize=true',
        cooperativeGestures: !0,
        center: [
          currentMap.getAttribute('data-longitude'),
          currentMap.getAttribute('data-latitude')
        ],
        zoom: 16,
        attributionControl: !1
      }),
      locations = {},
      nearbyLocations = exploreMaps[i].querySelectorAll(
        'button.nearby-location'
      ),
      nearbyLocationsLength = nearbyLocations.length;
    for (let x = 0; x < nearbyLocationsLength; x++)
      locations[nearbyLocations[x].getAttribute('id')] = {
        center: [
          nearbyLocations[x].getAttribute('data-longitude'),
          nearbyLocations[x].getAttribute('data-latitude')
        ],
        zoom: 16
      };
    const oliveMarker = document.createElement('div'),
      markerWidth = 28,
      markerHeight = 34;
    (oliveMarker.className = 'olive-map-marker'),
      (oliveMarker.style.backgroundImage = `url("${currentMap.getAttribute(
        'data-pin-olive'
      )}")`),
      (oliveMarker.style.width = `${markerWidth}px`),
      (oliveMarker.style.height = `${markerHeight}px`),
      (oliveMarker.style.backgroundSize = '100%');
    let activeLocation = '',
      marker = new mapboxgl.Marker({
        anchor: 'bottom',
        element: oliveMarker
      }),
      popup = !1;
    function setActiveLocation(location) {
      if (location === activeLocation) return;
      let currentLocation = document.getElementById(location),
        currentCoordinates = [
          currentLocation.getAttribute('data-longitude'),
          currentLocation.getAttribute('data-latitude')
        ],
        html = `<p class="mapboxgl-popup-title">${
          currentLocation.querySelector('.nearby-location__title').innerText
        }</p><div class="mapboxgl-popup-distance">${
          currentLocation.querySelector('.nearby-location__traffic').innerHTML
        }</div><div class="mapboxgl-popup-buttons">${
          currentLocation.querySelector('.nearby-location__cta').innerHTML
        }</div>`;
      const popupOffsets = {
        
        left: [40, -50],
        right: [-50, 80]
      };
      popup
        ? (popup.remove(),
          (popup = new mapboxgl.Popup({
            closeOnClick: !1,
            focusAfterOpen: !1,
            maxWidth: '300px',
            offset: popupOffsets
          })
            .setLngLat(currentCoordinates)
            .setHTML(html)
            .addTo(map)),
          marker.remove(),
          marker.setLngLat(currentCoordinates).addTo(map))
        : ((popup = new mapboxgl.Popup({
            closeOnClick: !1,
            focusAfterOpen: !1,
            maxWidth: '300px',
            offset: popupOffsets
          })
            .setLngLat(currentCoordinates)
            .setHTML(html)
            .addTo(map)),
          marker.setLngLat(currentCoordinates).addTo(map)),
        map.flyTo(locations[location]),
        currentLocation.classList.add('active'),
        '' != activeLocation &&
          document.getElementById(activeLocation).classList.remove('active');
      let boundingBox = [
        [
          currentMap.getAttribute('data-longitude'),
          currentMap.getAttribute('data-latitude')
        ],
        [
          currentLocation.getAttribute('data-longitude'),
          currentLocation.getAttribute('data-latitude')
        ]
      ];
      getRoute(map, boundingBox[0], boundingBox[1]),
        window.matchMedia('(max-width: 767px)').matches
          ? map.fitBounds(boundingBox, {
              padding: { top: 60, bottom: 60, left: 60, right: 60 }
            })
          : map.fitBounds(boundingBox, {
              padding: { top: 120, bottom: 120, left: 120, right: 120 }
            }),
        (activeLocation = location);
    }
    map.addControl(new mapboxgl.NavigationControl()),
      map.on('load', () => {
        map.loadImage(currentMap.getAttribute('data-pin'), (error, image) => {
          if (error) throw error;
          map.addImage('custom-marker', image),
            map.addSource('point', {
              type: 'geojson',
              data: {
                type: 'FeatureCollection',
                features: [
                  {
                    type: 'Feature',
                    geometry: {
                      type: 'Point',
                      coordinates: [
                        currentMap.getAttribute('data-longitude'),
                        currentMap.getAttribute('data-latitude')
                      ]
                    }
                  }
                ]
              }
            }),
            map.addLayer({
              id: 'point',
              type: 'symbol',
              source: 'point',
              layout: {
                'icon-anchor': 'bottom',
                'icon-image': 'custom-marker',
                'icon-size': 1
              }
            });
        });
        let activeButton = '';
        for (let i = 0; i < nearbyLocationsLength; i++)
          nearbyLocations[i].addEventListener('click', function() {
            let location = this.getAttribute('id');
            this != activeButton && '' != activeButton
              ? (activeButton.classList.remove('active'),
                this.classList.add('active'),
                (activeButton = this))
              : (this.classList.add('active'), (activeButton = this)),
              setActiveLocation(location),
              popup &&
                popup.on('close', () => {
                  (activeLocation = ''),
                    marker.remove(),
                    (popup = !1),
                    map.getLayer('route') &&
                      map.removeLayer('route').removeSource('route');
                });
          });
      });
  }
}
async function getRoute(map, start, end) {
  const query = await fetch(
      `https://api.mapbox.com/directions/v5/mapbox/driving/${start[0]},${
        start[1]
      };${end[0]},${end[1]}?&geometries=geojson&access_token=${
        mapboxgl.accessToken
      }`,
      { method: 'GET' }
    ),
    geojson = {
      type: 'Feature',
      properties: {},
      geometry: {
        type: 'LineString',
        coordinates: (await query.json()).routes[0].geometry.coordinates
      }
    };
  map.getSource('route')
    ? map.getSource('route').setData(geojson)
    : map.addLayer({
        id: 'route',
        type: 'line',
        source: { type: 'geojson', data: geojson },
        layout: { 'line-join': 'round', 'line-cap': 'round' },
        paint: {
          'line-color': '#58281D',
          'line-width': 5,
          'line-opacity': 1
        }
      });
}
document.addEventListener('DOMContentLoaded', function() {
  initMap();
});

(function($) {
  function ajaxLocations(cat) {
    const $parent = $('.locations-nearby');
    $.ajax({
      url: ajaxurl,
      type: 'POST',
      data: {
        action: 'loadAjaxLocations',
        cat
      },
      beforeSend: function() {
        $parent.html(
          '<div class="lds-wrapper"><div class="lds-ring"><div></div><div></div><div></div><div></div></div></div>'
        );
      },
      success: function(res) {
        let json = $.parseJSON(res);
        let strHTML = json.output;
        $parent.html(strHTML);
        initMap();
      },
      complete: function() {}
    });
  }
  // filter locations
  $('.explore-cat').on('click', function() {
    if ($(this).hasClass('is-active')) return;
    const cat = $(this).attr('data-cat');
    $('.explore-cat.is-active').removeClass('is-active');
    $(this).addClass('is-active');
    ajaxLocations(cat);
    return false;
  });
  $('.explore-select').on('change', function() {
    const cat = $(this).val();
    ajaxLocations(cat);
  });
})(jQuery);
