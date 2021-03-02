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
                            <th scope="col">Account</th>
                            <th scope="col">Level</th>
                            <th scope="col">Class</th>
                            <th scope="col">Online</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr
                            v-for="(ladder, index) in ladders.entries"
                            :key="index"
                        >
                            <td>{{ ladder.rank }}</td>
                            <td>{{ ladder.character.name }}</td>
                            <td>{{ ladder.account.name }}</td>
                            <td>{{ ladder.character.level }}</td>
                            <td>{{ ladder.character.class }}</td>
                            <td>{{ ladder.online }}</td>
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
