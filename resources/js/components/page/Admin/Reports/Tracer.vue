<template>
    <div class="sysconfig">
        <div class="w-full mx-auto mt-4 ml-20 rounded">
            <p class="text-2xl">Alumni Tracer Study</p>
            <div class="separator"></div>
            <div class="charts">
                <div class="bg-white w-full" style="border-radius: 5px; padding: 10px">
                    <apexchart width="100%" height="500" type="line" :options="answeredFormPerDay.options" :series="answeredFormPerDay.series" class="charts-object"></apexchart>
                </div>
            </div>
            <div class="bg-white w-full" style="border-radius: 5px; padding: 10px; ">
                <div v-for="(report, index) in this.report_data.tracer"  style="display: flex">
                    <div class="charts" style="width: 100%">
                        <apexchart width="98%" height="700" type="bar" :options="getChartOptions(report, index)" :series="getChartSeries(report)" class="charts-object"></apexchart>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    import QuestionHelper from "../../../../plugins/mixins/QuestionHelper";

    export default {
        name: "AlumniTracerStudy",
        data() {
           return {
               report_data: {}
           }
        },
        mixins: {
            QuestionHelper
        },
        beforeCreate() {
            this.$root.getRequest('v1/reports/tracer', (mResult) => {
                this.report_data = mResult
            });
        },
        computed: {
            answeredFormPerDay() {
                return {
                    series: [
                        {
                            name: "Total Answered Forms per Day",
                            data: Object.values(this.report_data.answered_per_day ?? {})
                        }
                    ],
                    options: {
                        noData: {
                            text: "Loading...",
                            align: 'center',
                            verticalAlign: 'middle',
                            offsetX: 0,
                            offsetY: 0,
                            style: {
                                color: "#000000",
                                fontSize: '14px',
                                fontFamily: "Helvetica"
                            }
                        },
                        title: {
                            text: 'Answered Forms per Day',
                            align: 'left'
                        },
                        chart: {
                            height: 350,
                            type: 'line',
                            dropShadow: {
                                enabled: true,
                                color: '#000',
                                top: 18,
                                left: 7,
                                blur: 10,
                                opacity: 0.2
                            },
                            toolbar: {
                                show: true
                            }
                        },
                        colors: ['#77B6EA', '#545454'],
                        dataLabels: {
                            enabled: true,
                        },
                        stroke: {
                            curve: 'smooth'
                        },
                        grid: {
                            borderColor: '#e7e7e7',
                            row: {
                                colors: ['#f3f3f3', 'transparent'], // takes an array which will be repeated on columns
                                opacity: 0.5
                            },
                        },
                        markers: {
                            size: 1
                        },
                        xaxis: {
                            categories: Object.keys(this.report_data.answered_per_day ?? {}),
                            title: {
                                text: 'Date'
                            },
                            labels: {
                                formatter: function (val) {
                                    return new Date(val).toDateString();
                                },
                            }
                        },
                        yaxis: {
                            title: {
                                text: 'Total form answered per day'
                            },
                        },
                        legend: {
                            position: 'top',
                            horizontalAlign: 'right',
                            floating: true,
                            offsetY: -25,
                            offsetX: -5
                        }
                    },
                }
            },
        },
        created() {
            this.$root.setUserInfo();
        },
        mounted() {
        },
        methods: {
            getChartOptions(oData, sChartName, iIndex = 0) {
                return {
                    noData: {
                        text: "Loading...",
                        align: 'center',
                        verticalAlign: 'middle',
                        offsetX: 0,
                        offsetY: 0,
                        style: {
                            color: "#000000",
                            fontSize: '14px',
                            fontFamily: "Helvetica"
                        }
                    },
                    title: {
                        text: sChartName,
                        align: 'left'
                    },
                    chart: {
                        type: 'bar',
                        height: 350,
                        stacked: true,
                    },
                    plotOptions: {
                        bar: {
                            horizontal: true,
                        },
                    },
                    stroke: {
                        width: 1,
                        colors: ['#fff']
                    },
                    xaxis: {
                        categories: oData[Object.keys(oData)[iIndex]].questions ?? {},
                        labels: {
                            formatter: function (val) {
                                return val
                            }
                        }
                    },
                    yaxis: {
                        title: {
                            text: undefined
                        },
                    },
                    tooltip: {
                        y: {
                            formatter: function (val) {
                                return val
                            }
                        }
                    },
                    fill: {
                        opacity: 1
                    },
                    legend: {
                        position: 'top',
                        horizontalAlign: 'left',
                        offsetX: 40
                    }
                }
            },
            getChartSeries(oData, iIndex = 0) {
                let aSeries = [];
                $.each(oData[Object.keys(oData)[iIndex]].ranking, function(sIndex, oValue) {
                    aSeries.push({
                        name : sIndex,
                        data : Object.values(oValue)
                    });
                });
                $.each((oData[Object.keys(oData)[1]] !== undefined) ? oData[Object.keys(oData)[1]].ranking : {}, function(sIndex, oValue) {
                    aSeries.push({
                        name : sIndex,
                        data : Object.values(oValue)
                    });
                });
                return aSeries;
            }
        }
    }
</script>

<style scoped>
    @import './reports.css';
    .charts .charts-object {
        text-align: -webkit-center;
        margin-top: 10px;
    }
    .charts .charts-label {
        font-weight: bold;
        font-size: 20px;
    }
</style>
