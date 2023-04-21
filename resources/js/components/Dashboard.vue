<script>
    import VueCookies from 'vue-cookies';

    export default { 
        data() {
            return {
                email: VueCookies.get('email'),
                token: VueCookies.get('token')
            }
        }
    }
     
</script>

<template>
    <div>
       Hello {{email}} ! 
    </div>
</template>