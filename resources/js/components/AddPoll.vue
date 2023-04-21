<script>
import VueCookies from 'vue-cookies';

export default {
    data() {
        return {
            choices: [],
            csrf: document.head.querySelector('meta[name="csrf-token"]').content,
            email: VueCookies.get('email')
        }
    },
    methods: {
        removeChild: (choices) => {
            event.preventDefault();
            let index = event.target.parentNode.id;
            choices.splice(index, 1)
        },
        add_choices: (choices) => {
            event.preventDefault();
            choices.push('');
        }
    }
  }
</script>
<template>
   <form action="/api/add-question" method="post">
        <div class="flex gap-2">
            <label>Write your question</label>
            <textarea name="statement"></textarea>
        </div>
        <div class="flex gap-2">
            <label>Expires at</label>
            <input type="date" name="expire_at"/>
        </div>
        <div class="flex gap-2">
            <label> Is single check? </label>
            <input type="checkbox" name="is_single_check" />
        </div>

        <div v-for="(textChoice, no) in choices" :key="no">
            <div :id="no" :key="no" class="flex gap-2">
                <textarea v-model="choices[no]" :name="no"/>
                <button  class="m-0.5 border border-1 rounded-md border-orange-500 py-0.5 px-1 cursor-pointer w-16" @click="removeChild(choices)">Delete</button>
            </div>
        </div>
        <div>
            <button @click="add_choices(choices)" class="m-0.5 border border-1 rounded-md border-orange-500 py-0.5 px-1 cursor-pointer w-28">Add choices</button>
            <input  class="m-0.5 border border-1 rounded-md border-orange-500 py-0.5 px-1 cursor-pointer w-36" type="submit" value="Add poll question"/>
        </div>
        <input type="hidden" name="_token" :value="csrf" />
        <input type="hidden" name="count" :value="choices.length"/>
        <input type="hidden" name="email" :value="email"/>
    </form>
</template>