<template>
    <div>
        <base-header type="gradient-default" class="pb-6 pb-8 pt-5 pt-md-8">
            <span class="mask bg-gradient-dark opacity-7"></span>
            <div class="row">
                <div class="col-xl-6 col-lg-6">
                    <stats-card
                        title="Total Donations"
                        type="gradient-red"
                        :sub-title="totalDonations"
                        icon="ni ni-active-40"
                        class="mb-4 mb-xl-0"
                    >
                    </stats-card>
                </div>
                <div class="col-xl-6 col-lg-6">
                    <stats-card
                        title="Total Amount Donated"
                        type="gradient-red"
                        :sub-title="totalAmount"
                        icon="ni ni-money-coins"
                        class="mb-4 mb-xl-0"
                    >
                    </stats-card>
                </div>
            </div>
        </base-header>
        <div class="container-fluid mt--7">
            <div class="row">
                <div class="col-xl-12">
                    <card header-classes="bg-transparent">
                        <div slot="header" class="row align-items-center">
                            <div class="col">
                                <h6 class="text-uppercase text-muted ls-1 mb-1">
                                    Performance
                                </h6>
                                <h5 class="h3 mb-0">Total donations</h5>
                            </div>
                        </div>

                        <bar-chart
                            :height="350"
                            ref="barChart"
                            :chart-data="redBarChart.chartData"
                        >
                        </bar-chart>
                    </card>
                </div>
            </div>
            <!-- End charts-->

            <!--Tables-->
            
                <div class="shadow col-xl-12 px-0 mt-5 mb-5 mb-xl-0">
                    <page-visits-table
                        :donations="donations"
                    ></page-visits-table>
                
            </div>
        </div>
    </div>
</template>
<script>
// Charts
import * as chartConfigs from "@/components/Charts/config";
import BarChart from "@/components/Charts/BarChart";
import PageVisitsTable from "./Dashboard/PageVisitsTable";

import User from "../api/User";

export default {
    components: {
        BarChart,
        PageVisitsTable
    },
    data() {
        return {
            bigLineChart: {
                allData: [
                    [0, 20, 10, 30, 15, 40, 20, 60, 60],
                    [0, 20, 5, 25, 10, 30, 15, 40, 40]
                ],
                activeIndex: 0,
                chartData: {
                    datasets: [],
                    labels: []
                },
                extraOptions: chartConfigs.blueChartOptions
            },
            redBarChart: {
                chartData: {
                    labels: ["Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
                    datasets: [
                        {
                            label: "Sales",
                            data: [25, 20, 30, 22, 17, 29]
                        }
                    ]
                }
            },
            totalDonations: "",
            totalAmount: "",
            donations: []
        };
    },
    methods: {
        initBigChart(index) {
            let chartData = {
                datasets: [
                    {
                        label: "Performance",
                        data: this.bigLineChart.allData[index]
                    }
                ],
                labels: ["May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"]
            };
            this.bigLineChart.chartData = chartData;
            this.bigLineChart.activeIndex = index;
        },
        getTotalAmount(donations) {
            var sum = 0;
            for (var index in donations) {
                sum += parseFloat(donations[index].amount);
            }
            return sum;
        }
    },
    mounted() {
        this.initBigChart(0);
        User.getDashboard().then(response => {
            this.totalDonations = response.data.totalTranasaction.toString();
            this.totalAmount = this.getTotalAmount(
                response.data.transaction
            ).toString();
            this.donations = response.data.transaction;
        });
    }
};
</script>
<style></style>
