<template>
    <div class="sysconfig">
        <div class="w-full mx-auto mt-4 ml-20 rounded">
            <p class="text-2xl">System Logs</p>
            <div class="separator"></div>
            <div class="flex flex-wrap">
                <div class="w-full">
                    <ul class="flex mb-0 list-none flex-wrap pt-3 pb-4 flex-row">
                        <li class="-mb-px mr-2 last:mr-0 flex-auto text-center">
                            <a class=" font-bold uppercase px-5 py-3 shadow-lg rounded block leading-normal" v-on:click="toggleTabs(1)" v-bind:class="{'text-indigo-600 bg-white': openTab !== 1, 'text-white bg-indigo-600': openTab === 1}">
                                <i class="fas fa-space-shuttle text-base mr-1"></i> Today Measured By Time
                            </a>
                        </li>
                        <li class="-mb-px mr-2 last:mr-0 flex-auto text-center">
                            <a class=" font-bold uppercase px-5 py-3 shadow-lg rounded block leading-normal" v-on:click="toggleTabs(2)" v-bind:class="{'text-indigo-600 bg-white': openTab !== 2, 'text-white bg-indigo-600': openTab === 2}">
                                <i class="fas fa-cog text-base mr-1"></i> By Week Measured By Days
                            </a>
                        </li>
                        <li class="-mb-px mr-2 last:mr-0 flex-auto text-center">
                            <a class=" font-bold uppercase px-5 py-3 shadow-lg rounded block leading-normal" v-on:click="toggleTabs(3)" v-bind:class="{'text-indigo-600 bg-white': openTab !== 3, 'text-white bg-indigo-600': openTab === 3}">
                                <i class="fas fa-briefcase text-base mr-1"></i> By Month Measured By Weeks
                            </a>
                        </li>
                    </ul>
                    <div class="relative flex flex-col min-w-0 break-words bg-white w-full mb-6 shadow-lg rounded">
                        <div class="px-4 py-5 flex-auto">
                            <div class="tab-content tab-space">
                                <div v-bind:class="{'hidden': openTab !== 1, 'block': openTab === 1}">
                                    <div class="charts">
                                        <div class="bg-white w-full" style="border-radius: 5px; padding: 10px">
                                            <apexchart width="100%" height="500" type="line" :options="LoginPerDay.options" :series="LoginPerDay.series" class="charts-object"></apexchart>
                                        </div>
                                    </div>
                                </div>
                                <div v-bind:class="{'hidden': openTab !== 2, 'block': openTab === 2}">
                                    <div class="charts">
                                        <div class="bg-white w-full" style="border-radius: 5px; padding: 10px">
                                            <apexchart width="100%" height="500" type="line" :options="LoginPerWeek.options" :series="LoginPerWeek.series" class="charts-object"></apexchart>
                                        </div>
                                    </div>
                                </div>
                                <div v-bind:class="{'hidden': openTab !== 3, 'block': openTab === 3}">
                                    <div class="charts">
                                        <div class="bg-white w-full" style="border-radius: 5px; padding: 10px">
                                            <apexchart width="100%" height="500" type="line" :options="LoginPerMonth.options" :series="LoginPerMonth.series" class="charts-object"></apexchart>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        name: "Logs",
        data() {
            return {
                openTab: 1,
                report_data: {
                    day: {},
                    week: {},
                    month: {},
                }
            }
        },
        beforeCreate() {
        },
        computed: {
            LoginPerDay() {
                return {
                    series: [
                        {
                            name: "Frequency of log-ins per day measured by time",
                            data: Object.values(this.report_data.day ?? {})
                        }
                    ],
                    options: {
                        title: {
                            text: 'Frequency of log-ins per day measured by time',
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
                            categories: Object.keys(this.report_data.day ?? {}),
                            title: {
                                text: 'Time'
                            },
                            labels: {
                                formatter: function (val) {
                                    return new Date(val).toLocaleTimeString();
                                },
                            }
                        },
                        yaxis: {
                            title: {
                                text: 'Total log-ins per time'
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
            LoginPerWeek() {
                return {
                    series: [
                        {
                            name: "Frequency of log-ins per week measured by day",
                            data: Object.values(this.report_data.week ?? {})
                        }
                    ],
                    options: {
                        title: {
                            text: 'Frequency of log-ins per week measured by day',
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
                            categories: Object.keys(this.report_data.week ?? {}),
                            title: {
                                text: 'Day'
                            }
                        },
                        yaxis: {
                            title: {
                                text: 'Log-ins per day'
                            }
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
            LoginPerMonth() {
                return {
                    series: [
                        {
                            name: "Frequency of log-ins per month measured by week",
                            data: Object.values(this.report_data.month ?? {})
                        }
                    ],
                    options: {
                        title: {
                            text: 'Frequency of log-ins per month measured by week',
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
                            categories: Object.keys(this.report_data.month ?? {}),
                            title: {
                                text: 'Week'
                            },
                            labels: {
                                formatter: function (val) {
                                    return 'Week no. ' + val;
                                },
                            }
                        },
                        yaxis: {
                            title: {
                                text: 'Log-ins per week'
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
            this.callReportsData();
        },
        methods: {
            toggleTabs: function(tabNumber){
                if (this.openTab !== tabNumber) {
                    window.dispatchEvent(new Event('resize'));
                    this.callReportsData();
                }
                this.openTab = tabNumber;
            },
            callReportsData: function() {
                this.$root.getRequest('v1/reports/logs', (mResult) => {
                    this.report_data = mResult
                });
            }
        }
    }
</script>

<style scoped>
    @import './reports.css';
    li a {
        cursor: pointer;
    }
    .charts .charts-object {
        text-align: -webkit-center;
        margin-top: 10px;
    }
    .charts .charts-label {
        font-weight: bold;
        font-size: 20px;
    }
</style>
