<template>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <button
                    type="button"
                    class="btn btn-dark mr-1 mb-3 hover:shadow"
                    @click="updateLadders(league.id)"
                    v-for="(league, index) in leagues"
                    :key="index"
                >
                    {{ league.id }}
                </button>
            </div>
            <div class="col-12 overflow-scroll">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Character</th>
                            <th scope="col">Level</th>
                            <th scope="col">Account</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr
                            v-for="(ladder, index) in ladders.entries"
                            :key="index"
                        >
                            <td>{{ ladder.rank }}</td>
                            <td>
                                <div>
                                    {{ ladder.character.name }}
                                </div>
                                <div class="text-gray-500 text-xs">
                                    {{ ladder.character.class }}
                                </div>
                            </td>
                            <td>{{ ladder.character.level }}</td>
                            <td>
                                <div class="flex">
                                    <div>{{ ladder.account.name }}</div>
                                    <div v-if="ladder.public" class="ml-2">
                                        <a
                                            class="far fa-id-card text-yellow-900"
                                            :href="`https://www.pathofexile.com/account/view-profile/${ladder.account.name}/characters`"
                                        ></a>
                                    </div>
                                    <div
                                        v-if="ladder.account.twitch"
                                        class="ml-2"
                                    >
                                        <a
                                            class="fab fa-twitch text-purple-700"
                                            :href="`https://www.twitch.tv/${ladder.account.twitch.name}`"
                                        ></a>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <i
                                    class="fas fa-signal"
                                    :class="[
                                        ladder.online
                                            ? 'text-green-500'
                                            : 'text-red-500',
                                    ]"
                                ></i>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            leagues: [],
            ladders: [],
        };
    },
    mounted() {
        axios.get("/api/v1/poe/leagues").then((res) => {
            this.leagues = res.data;
        });
    },
    methods: {
        updateLadders(league) {
            console.log(league);
            axios.get(`/api/v1/poe/ladders/${league}`).then((res) => {
                this.ladders = res.data;
            });
        },
    },
};
</script>
