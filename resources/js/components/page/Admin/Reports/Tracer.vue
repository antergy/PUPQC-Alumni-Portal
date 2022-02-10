<template>
    <div class="sysconfig">
        <div class="w-full mx-auto mt-4 ml-20 rounded">
            <p class="text-2xl">Alumni Tracer Study</p>
            <div class="separator"></div>
            <div class="bg-white w-full" style="border-radius: 5px; padding: 10px; ">
                <div v-for="(report, index) in this.report_data"  style="display: flex">
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
        },
        created() {
            this.$root.setUserInfo();
        },
        mounted() {
        },
        methods: {
            getChartOptions(oData, sChartName, iIndex = 0) {
                return {
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
