<script>
export default {
  props: ['queryPath', 'idPath'],
  data() {
    return {
      questions: null,
    }
  },
   watch: {
    idPath: "fetchData"
  },
  created() {
    // fetch on init
    this.fetchData()
  },
  methods: {
    async fetchData(){
            const response = await axios.get("/api/list-vote/", {
                method: "GET",
                headers: {
                    "Content-Type": "application/json",
                }
            });
            this.questions = response.data;
        }
  }
}

</script>

<template>
 <div v-if="!!questions">
    <div v-for="(question, index) in questions" class="flex gap-2">
        <div class="text-xl m-0.5">Q{{index+1}}</div>
        <div class="text-xl m-0.5">
            {{question.statement}}
        </div>
        <div class="align-middle m-0.5 border border-1 rounded-md border-orange-500 p-0.5">
          <a :href="`/poll/${question.id}`"> Link to question</a>
        </div>
    </div>
 </div>
 <div v-else>Not found page</div>
</template>