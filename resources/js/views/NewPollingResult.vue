<template>
    <div class=" bg-white flex flex-wrap ">
        <form @submit.prevent>
            <h1 class="font-bold text-center  mt-20  md:mt-10 text-lg">
                Create Result for Polling New Unit
            </h1>
            <hr />
            <div class="mb-4 flex flex-col  shadow-lg bg-white">
                <div class="grid grid-cols-1 md:grid-cols-3 mb-6 gap-1">
                    <div class="ml-2">
                        <label
                            class="  mb-24 text-grey-darker text-sm "
                            for="rates"
                        >
                            Select polling unit
                        </label>
                        <select
                            v-model="formData.pollingUnit"
                            class="md:pl-12 lg:pl-10 shadow rounded focus:border-yellow-500 focus:outline-none  border border-red w-4/5    py-2 px-3 text-grey-darker"
                        >
                            <option value="">Select Polling Unit </option>
                            <option
                                v-for="result in results"
                                :key="result.uniqueid"
                                :value="result.uniqueid"
                                >{{
                                    result.polling_unit_name
                                }}&nbsp;&nbsp;&nbsp;({{
                                    result.polling_unit_number
                                }})</option
                            >
                        </select>
                    </div>

                    <div class="ml-2">
                        <label
                            class=" left-4  mb-24 text-grey-darker text-sm "
                            for="design"
                        >
                            Select Party
                        </label>
                        <select
                            v-model="formData.party"
                            class="md:pl-12 lg:pl-10 shadow rounded focus:border-yellow-500 focus:outline-none  border border-red w-4/5    py-2 px-3 text-grey-darker"
                        >
                            <option value="">Select Party</option>
                            <option
                                v-for="result in parties"
                                :key="result.id"
                                :value="result.partyname"
                                >{{ result.partyname }}</option
                            >
                        </select>
                    </div>

                    <div class="ml-2">
                        <label
                            class=" left-4  mb-24 text-grey-darker text-sm "
                            for="design"
                        >
                            Enter Party's Score
                        </label>
                        <input
                            id="design"
                            v-model="formData.party_score"
                            class="shadow focus:border-yellow-500 focus:outline-none appearance-none  border rounded w-11/12 py-2 px-3 text-grey-darker"
                        />
                    </div>

                    <div class="ml-2">
                        <label
                            class=" left-4  mb-24 text-grey-darker text-sm "
                            for="design"
                        >
                            Enter Your Name
                        </label>
                        <input
                            id="design"
                            v-model="formData.entered_by_user"
                            class="shadow focus:border-yellow-500 focus:outline-none appearance-none  border rounded w-11/12 py-2 px-3 text-grey-darker"
                        />
                    </div>

                    <div class="ml-2">
                        <label>&nbsp;</label>
                        <button
                            @click="submitResults"
                            class="
              block w-11/12 bg-green-700  hover:bg-green-600 text-white  py-2 px-4 rounded justify-center  content-center"
                        >
                            <span
                                :class="loadSpin"
                                class="animate-spin absolute inline-flex h-5 w-5   rounded-full border-4  border-dotted border-red-400 "
                            ></span>

                            <span class="pl-6 pr-6">+Add Result</span>
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</template>

<script>
import axios from "axios";
export default {
    created() {
        this.fetchPollingUnits();
        this.fetchParties();
    },
    data: function() {
        return {
            results: [],
            pollingUnits: [],
            UniqueId: "",
            parties: [],
            loadSpin: false,
            formData: {
                name: "",
                party_score: "",
                entered_by_user: "",
                party: "",
                pollingUnit: ""
            }
        };
    },

    methods: {
        async fetchPollingUnits() {
            let response = await fetch("/api/polling_units");
            if (response.status !== 200) {
                console.log(
                    "Looks like there was a problem. Status Code: " +
                        response.status
                );

                return;
            }

            response.json().then(async data => {
                this.results = data.content;
            });
        },

        async fetchParties() {
            let response = await fetch("/api/parties");
            if (response.status !== 200) {
                console.log(
                    "Looks like there was a problem. Status Code: " +
                        response.status
                );

                return;
            }

            response.json().then(async data => {
                this.parties = data.content;
            });
        },

        submitResults() {
            axios
                .post("/api/store_results", this.formData)
                .then(resp => {
                    console.log(resp);
                    alert("Added Successfully.");
                })
                .catch(err => {
                    console.error(err);
                });
        }
    }
};
</script>
