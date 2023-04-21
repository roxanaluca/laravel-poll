<script>
import CryptoJS from 'crypto-js';
import VueCookies from 'vue-cookies';

export default {
    data() {
        return {
            passwordInputType: "password",
            username: "",
            pasfsword: "",
            loginMessage: "",
        }
    },
    methods: {
        setEmail: (currentEmail) => { 
            VueCookies.set('email', currentEmail, '1h');
        },
        setToken: (currentToken) => { 
            VueCookies.set('token', currentToken, '1h');
        },
        setIsLoggin: (currentIsLoggin) => {
            VueCookies.set('isLoggin', currentIsLoggin, '1h');
        },
        changePasswordField() {
            if (this.passwordInputType == "password")
                this.passwordInputType = "text";
            else 
                this.passwordInputType="password";
        },
        async getToken() {
            if (!this.password || !this.username) {
                this.loginMessage = 'Missing password/username';
                return;
            }

            const password = CryptoJS.enc.Base64.stringify(CryptoJS.enc.Utf8.parse(this.password));

            try {
                const response = await axios.post("/api/user", {
                    email: this.username,
                    password,
                    device_name: window.navigator.userAgent
                });
                this.setToken(response.data.token);
                this.setEmail(this.username);
                this.setIsLoggin(true);
                document.location.href = '/';
            } catch(e) {
                this.loginMessage = "Username or password is wrong. Please try again!"
            }
        }
    }
}

</script>
<template>
    <div>
        <div class="flex gap-2">
            <label class="text-xl">Username</label>
            <input type="text" v-model="username"/>
        </div>
        <div class="flex gap-2 ">
            <label class="text-xl">Password</label>
            <input :type="passwordInputType" v-model="password"/>
        </div>
        <div class="m-0.5 border border-1 rounded-md border-orange-500 py-0.5 px-1 cursor-pointer w-32" :onclick="changePasswordField">Show password</div>
        <div class="m-0.5 border border-1 rounded-md border-orange-500 py-0.5 px-1 cursor-pointer w-16" :onclick="getToken"> Submit</div>
        <div> {{loginMessage}}</div>
    </div>
</template>