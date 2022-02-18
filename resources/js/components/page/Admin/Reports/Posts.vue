<template>
    <div class="sysconfig">
        <div class="w-full mx-auto mt-4 ml-20 rounded">
            <p class="text-2xl">Post Activities</p>
            <div class="separator"></div>
            <div class="bg-white w-full" style="border-radius: 5px; padding: 10px; ">
                <div style="display: flex">
                    <div class="charts" style="width: 100%">
<!--                        <label class="charts-label">Count of Created Posts Per Day </label>-->
                        <apexchart width="100%" height="500" type="line" :options="CountCreatedPostPerDay.options" :series="CountCreatedPostPerDay.series" class="charts-object"></apexchart>
                    </div>
                </div>
                <div style="display: flex">
                    <div class="charts" style="width: 33%">
                        <!--                        <label class="charts-label">Count of Posts Per Post Types </label>-->
                        <apexchart width="100%" height="500" type="bar" :options="CountPostsPerPostType.options" :series="CountPostsPerPostType.series" class="charts-object"></apexchart>
                    </div>
                    <div class="charts" style="width: 33%">
<!--                        <label class="charts-label">Count of Posts Per Post Types </label>-->
                        <apexchart width="100%" height="500" type="bar" :options="NumberOfLikesPerPostType.options" :series="NumberOfLikesPerPostType.series" class="charts-object"></apexchart>
                    </div>
                    <div class="charts" style="width: 33%">
<!--                        <label class="charts-label">Count of Created Posts Per Day </label>-->
                        <apexchart width="100%" height="500" type="bar" :options="NumberOfCommentsPerPostType.options" :series="NumberOfCommentsPerPostType.series" class="charts-object"></apexchart>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        name: "PostActivities",
        data() {
            return {
                report_data: {
                    created_posts_per_day : {},
                    all_posts : {},
                    comments : {},
                    likes : {}
                },
            }
        },
        computed: {
            CountPostsPerPostType() {
                return {
                    series: [{
                        name: 'Count of Posts Per Post Type',
                        data: Object.values(this.report_data.all_posts ?? {}),
                    }],
                    options: {
                        title: {
                            text: 'Count of Posts Per Post Type',
                            align: 'left'
                        },
                        chart: {
                            type: 'bar',
                            height: 350
                        },
                        plotOptions: {
                            bar: {
                                horizontal: false,
                                columnWidth: '55%',
                                endingShape: 'rounded'
                            },
                        },
                        dataLabels: {
                            enabled: false
                        },
                        stroke: {
                            show: true,
                            width: 2,
                            colors: ['transparent']
                        },
                        xaxis: {
                            categories: Object.keys(this.report_data.all_posts ?? {}),
                        },
                        yaxis: {
                            title: {
                                text: 'Number of Posts'
                            }
                        },
                        fill: {
                            opacity: 1
                        },
                        tooltip: {
                            y: {
                                formatter: function (val) {
                                    return "Total Post: " + val
                                }
                            }
                        }
                    }
                }
            },
            CountCreatedPostPerDay() {
                return {
                    series: [
                        {
                            name: "Created Post Per Day",
                            data: Object.values(this.report_data.created_posts_per_day ?? {}),
                        }
                    ],
                    options: {
                        title: {
                            text: 'Count of Created Posts Per Day',
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
                            categories: Object.keys(this.report_data.created_posts_per_day ?? {}),
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
                                text: 'Total Count Of Created Post'
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
            NumberOfLikesPerPostType() {
                return {
                    series: [{
                        name: 'Count of Likes',
                        data: Object.values(this.report_data.likes ?? {}),
                    }],
                    options: {
                        title: {
                            text: 'Number of Likes Per Post Type',
                            align: 'left'
                        },
                        chart: {
                            type: 'bar',
                            height: 350
                        },
                        plotOptions: {
                            bar: {
                                horizontal: false,
                                columnWidth: '55%',
                                endingShape: 'rounded'
                            },
                        },
                        dataLabels: {
                            enabled: false
                        },
                        stroke: {
                            show: true,
                            width: 2,
                            colors: ['transparent']
                        },
                        xaxis: {
                            categories: Object.keys(this.report_data.likes ?? {}),
                        },
                        yaxis: {
                            title: {
                                text: 'Number of Likes'
                            }
                        },
                        fill: {
                            opacity: 1
                        },
                        tooltip: {
                            y: {
                                formatter: function (val) {
                                    return "Total Likes: " + val
                                }
                            }
                        }
                    }
                }
            },
            NumberOfCommentsPerPostType() {
                return {
                    series: [{
                        name: 'Count of Comments',
                        data: Object.values(this.report_data.comments ?? {}),
                    }],
                    options: {
                        title: {
                            text: 'Number of Comments Per Post Type',
                            align: 'left'
                        },
                        chart: {
                            type: 'bar',
                            height: 350
                        },
                        plotOptions: {
                            bar: {
                                horizontal: false,
                                columnWidth: '55%',
                                endingShape: 'rounded'
                            },
                        },
                        dataLabels: {
                            enabled: false
                        },
                        stroke: {
                            show: true,
                            width: 2,
                            colors: ['transparent']
                        },
                        xaxis: {
                            categories: Object.keys(this.report_data.comments ?? {}),
                        },
                        yaxis: {
                            title: {
                                text: 'Number of Comments'
                            }
                        },
                        fill: {
                            opacity: 1
                        },
                        tooltip: {
                            y: {
                                formatter: function (val) {
                                    return "Total Comment/s: " + val
                                }
                            }
                        }
                    }
                }
            }
        },
        beforeCreate() {
            this.$root.getRequest('v1/reports/posts', (mResult) => {
                this.report_data = mResult
            });
        },
        created() {
            this.$root.setUserInfo();
        },
        mounted() {
        },
        methods: {
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
