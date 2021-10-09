<template>
    <div class=" bg-white grid grid-cols-1 ">
        <div class="">
            <h4 class="font-extrabold">Select Local Government.</h4>
            <select
                v-model="LGAId"
                @change="fetchEachLGAs"
                class="md:pl-12 lg:pl-10 shadow rounded focus:border-yellow-500 focus:outline-none  border border-red w-4/5    py-2 px-3 text-grey-darker"
            >
                <option
                    v-for="result in results"
                    :key="result.lga_id"
                    :value="result.lga_id"
                    >{{ result.lga_name }}</option
                >
            </select>
        </div>
        <div
            class="col-span-2 mt-10 p-2 md:p-10 bg-white shadow-md overflow-scroll"
        >
            <h4
                class="border-b-4 border-green-500 m-2 text-center text-xl xl:text-2xl font-extrabold"
            >
                Polling Results for LGA:  <i>{{ LGAName }}</i>
            </h4>

            <table class="table " id="datatable">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Party Abbreviation</th>
                        <th>Party Score</th>
                        <th>Created At</th>
                    </tr>
                </thead>
                <tbody>
                    <tr
                        v-for="(pollingUnit, index) in pollingUnits"
                        :key="pollingUnit.result_id"
                    >
                        <td>{{ index + 1 }}</td>
                        <td>{{ pollingUnit.party_abbreviation }}</td>
                        <td>{{ pollingUnit.party_score }}</td>
                        <td>{{ pollingUnit.date_entered }}</td>
                    </tr>
                </tbody>
            </table>
            <router-link
                class="
                text-center
              block w-full md:w-9/12 bg-green-900 hover:bg-green-500 text-white font-bold py-2 px-4 rounded justify-center  content-center
            "
                to="/dashboard"
                >Return to polling units
            </router-link>
        </div>
    </div>
</template>

<script>
import "jquery/dist/jquery.min.js";
import "datatables.net-dt/js/dataTables.dataTables";
import "datatables.net-dt/css/jquery.dataTables.min.css";

import $ from "jquery";

export default {
    created() {
        this.fetchLGAs();
        this.fetchEachLGAs();
    },
    data: function() {
        return {
            results: [],
            pollingUnits: [],
            LGAId: 8,
            LGAName: ""
        };
    },

    methods: {
        async fetchLGAs() {
            let response = await fetch("/api/fetch_LGAs");
            if (response.status !== 200) {
                console.log(
                    "Looks like there was a problem. Status Code: " +
                        response.status
                );

                return;
            }

            response.json().then(async data => {
                this.results = data.content;
                setTimeout(function() {
                    $(
                        function() {
                            $("#datatable").DataTable();
                        }.bind(this)
                    );
                }, 3000);
            });
        },

        async fetchEachLGAs(event) {
            if (event) {
                this.LGAId = event.target.value;
            }

            let response = await fetch(
                "/api/each_LGA_result/" + this.LGAId
            );
            if (response.status !== 200) {
                console.log(
                    "Looks like there was a problem. Status Code: " +
                        response.status
                );

                return;
            }

            response.json().then(async data => {
                this.pollingUnits = data.content;
                this.LGAName = data.lga_details.lga_name;
                setTimeout(function() {
                    $(
                        function() {
                            $("#datatable").DataTable();
                        }.bind(this)
                    );
                }, 3000);
            });
        }
    }
};
</script>
