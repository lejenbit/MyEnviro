define([
    'esri/dijit/Basemap',
    'esri/dijit/BasemapLayer'
    //'esri/layers/osm'
], function ( Basemap, BasemapLayer ) {
    return {
        map: true, // needs a refrence to the map
        mode: 'custom', //must be either 'agol' or 'custom'
        title: 'Basemaps', // title for widget
        mapStartBasemap: 'streets', // must match one of the basemap keys below
        //basemaps to show in menu. define in basemaps object below and reference by name here
        // TODO Is this array necessary when the same keys are explicitly included/excluded below?
        basemapsToShow: ['streets', 'googleStreets', 'googleSatellite', 'googleHybrid', 'googleTerrain'],

        // define all valid custom basemaps here. Object of Basemap objects. For custom basemaps, the key name and basemap id must match.
        basemaps: {
            streets: {
                title: 'Streets',
                basemap: new Basemap({
                    id: 'streets',
                    layers: [new BasemapLayer({
                        url: 'http://services.arcgisonline.com/ArcGIS/rest/services/World_Street_Map/MapServer'
                    })]
                })
            },
       /*      satellite: {
                title: 'Satellite',
                basemap: new Basemap({
                    id: 'satellite',
                    layers: [new BasemapLayer({
                        url: 'http://services.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer'
                    })]
                })
            },
            hybrid: {
                title: 'Hybrid',
                basemap: new Basemap({
                    id: 'hybrid',
                    layers: [new BasemapLayer({
                        url: 'http://services.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer'
                    }), new BasemapLayer({
                        url: 'http://services.arcgisonline.com/ArcGIS/rest/services/Reference/World_Boundaries_and_Places/MapServer',
                        isReference: true,
                        displayLevels: [0, 1, 2, 3, 4, 5, 6, 7]
                    }), new BasemapLayer({
                        url: 'http://services.arcgisonline.com/ArcGIS/rest/services/Reference/World_Transportation/MapServer',
                        isReference: true,
                        displayLevels: [8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19]
                    })]
                })
            },
            lightGray: {
                title: 'Light Gray Canvas',
                basemap: new Basemap({
                    id: 'lightGray',
                    layers: [new BasemapLayer({
                        url: 'http://services.arcgisonline.com/ArcGIS/rest/services/Canvas/World_Light_Gray_Base/MapServer'
                    }), new BasemapLayer({
                        url: 'http://services.arcgisonline.com/ArcGIS/rest/services/Canvas/World_Light_Gray_Reference/MapServer',
                        isReference: true
                    })]
                })
            }, */
            googleStreets: {
                title: 'Google Streets',
                basemap: new Basemap({
                    id: 'googleStreets',
                    layers: [new BasemapLayer({
                        url: "http://mt${subDomain}.google.com/vt/lyrs=m&hl=en&gl=en&x=${col}&y=${row}&z=${level}&s=png",
                        copyright: "Google, 2015",
                        id: "googleStreets",
                        subDomains: ["0", "1", "2", "3"],
                        type:"WebTiledLayer"
                        })
                    ]
                })
            },
            googleSatellite: {
                title: 'Google Satellite',
                basemap: new Basemap({
                    id: 'googleSatellite',
                    layers: [new BasemapLayer({
                        url: "http://mt${subDomain}.google.com/vt/lyrs=s&hl=en&gl=en&x=${col}&y=${row}&z=${level}&s=png",
                        copyright: "Google, 2015",
                        id: "googleSatellite",
                        subDomains: ["0", "1", "2", "3"],
                        type:"WebTiledLayer"
                        })
                    ]
                })
            },
            googleHybrid: {
                title: 'Google Hybrid',
                basemap: new Basemap({
                    id: 'googleHybrid',
                    layers: [new BasemapLayer({
                        url: "http://mt${subDomain}.google.com/vt/lyrs=s,h&hl=en&gl=en&x=${col}&y=${row}&z=${level}&s=png",
                        copyright: "Google, 2015",
                        id: "googleHybrid",
                        subDomains: ["0", "1", "2", "3"],
                        type:"WebTiledLayer"
                        })
                    ]
                })
            },
            googleTerrain: {
                title: 'Google Terrain',
                basemap: new Basemap({
                    id: 'googleTerrain',
                    layers: [new BasemapLayer({
                        url: "http://mt${subDomain}.google.com/vt/lyrs=t,r&hl=en&gl=en&x=${col}&y=${row}&z=${level}&s=png",
                        copyright: "Google, 2015",
                        id: "googleTerrain",
                        subDomains: ["0", "1", "2", "3"],
                        type:"WebTiledLayer"
                        })
                    ]
                })
            }
        }
    };
});