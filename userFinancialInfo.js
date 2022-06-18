$(document).ready(function () {
    AmCharts.makeChart("chartdiv",
        {
            "type": "serial",
            "categoryField": "month",
            "startDuration": 1,
            "fontSize": 13,
            "categoryAxis": {
                "gridPosition": "start"
            },
            "trendLines": [],
            "graphs": [
                {
                    "colorField": "color",
                    "fillAlphas": 1,
                    "id": "AmGraph-1",
                    "lineColorField": "color",
                    "title": "graph 1",
                    "type": "column",
                    "valueField": "monthCost"
                }
            ],
            "guides": [],
            "valueAxes": [
                {
                    "id": "ValueAxis-1",
                    "title": "BDT (TK)"
                }
            ],
            "allLabels": [],
            "balloon": {},
            "titles": [
                {
                    "id": "Title-1",
                    "size": 15,
                    "text": "Your These Years Total Cost"
                }
            ],
            "dataProvider": [
                {
                    "month": "Jan",
                    "monthCost": "5203",
                    "color": "#42b3f4"
                },
                {
                    "month": "Feb",
                    "monthCost": "6512",
                    "color": "#41f4e2"
                },
                {
                    "month": "Mar",
                    "monthCost": "4521",
                    "color": "#dbdb8e"
                },
                {
                    "month": "Apr",
                    "monthCost": "4211",
                    "color": "#e5e522"
                },
                {
                    "month": "May",
                    "monthCost": "3601",
                    "color": "#e53f22"
                },
                {
                    "month": "Jun",
                    "monthCost": "9850",
                    "color": "#2269e5"
                },
                {
                    "month": "July",
                    "monthCost": "4562",
                    "color": "#e52286"
                },
                {
                    "month": "Aug",
                    "monthCost": "12500",
                    "color": "#d0c398"
                },
                {
                    "month": "Sep",
                    "monthCost": "12564",
                    "color": "#160505"
                },
                {
                    "month": "Oct",
                    "monthCost": "9851",
                    "color": "#63d3f2"
                },
                {
                    "month": "Nov",
                    "monthCost": "7452",
                    "color": "#edb6b6"
                },
                {
                    "month": "Dec",
                    "monthCost": "5623",
                    "color": "#f7df8a"
                }
            ]
        }
    );
});