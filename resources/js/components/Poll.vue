<script>
export default {
 props: ['idPath'],
  data() {
    return {
      question: null,
      choices: [],
      idPath: this.idPath,
      csrf: document.head.querySelector('meta[name="csrf-token"]').content
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
        if (!!this.idPath) {
            const response = await axios.get("/api/vote/" + this.idPath,{
                method: "GET",
                headers: {
                     "Content-Type": "application/json",
                }
            });
            this.question = response.data.question;
            this.choices = response.data.choices;
          }
    }
  }
}
</script>

<template>
<div v-if="!!question">
        <div>
            <div class="flex">
              <div class="text-xl">Question:</div> 
              <div class="m-1">{{question.statement}}</div>
            </div>
            <div class="flex">
              <div class="text-xl">Publish date: </div>
              <div class="m-1"> {{question.publish_date}} </div>
            </div>
            <div class="flex gap-1">
              <div class="text-xl"> Expire at: </div>
              <div v-if = "question.expires_at" class="m-1">
              {{question.expires_at}} 
              </div>
              <div v-else class="m-1">
                  Unlimited 
              </div>
            </div>
        </div>

        <form method="POST" action="/api/vote">
            <input type="hidden" name="_token" :value="csrf" />
            <input type="hidden" name="_id" :value="question.id">

                <div v-for="(choice, key) in choices">
                  <div class="flex gap-2">
                    <div v-if="question.is_single_check">
                        <input type="radio" name="answer" :value="key">
                    </div>
                    <div v-else> 
                        <input type="checkbox" name="answer[]" :value="key">
                    </div>
                    <div>
                        {{choice.statement}}
                    </div>
                  </div>
                </div>

            <input type="submit" value="Submit your answer" class="m-0.5 border border-1 rounded-md border-orange-500 p-0.5 cursor-pointer"/>
            </form>
        </div>
</template>