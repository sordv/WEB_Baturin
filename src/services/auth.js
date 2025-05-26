import AuthRepository from "../repository/auth.js";
import api from "./api.js";
import config from "./config.js";
import location from "./location.js";
import loading from "./loading.js";

class Auth {
    static get token () {
        return window.localStorage.getItem(config.AUTH_ACCESS_TOKEN)
    }

    static set token (value) {
        if (!value) {
            window.localStorage.removeItem(config.AUTH_ACCESS_TOKEN)
        } else {
            window.localStorage.setItem(config.AUTH_ACCESS_TOKEN, value)
        }
    }

    static async login (values) {
        try {
            loading.start();
            const response = await AuthRepository.login(values)
            Auth.token = response.data.accessToken

            await new Promise(resolve => setTimeout(resolve, 100));
            location.user()
        } catch (error) {
            console.error('Login error:', error);
            throw error;
        } finally {
            loading.stop();
        }
    }

    static async reg (values) {
        try {
            loading.start();
            const response = await AuthRepository.reg(values)
            Auth.token = response.data.accessToken
            
            await new Promise(resolve => setTimeout(resolve, 100));
            location.user()
        } catch (error) {
            console.error('Registration error:', error);
            throw error;
        } finally {
            loading.stop();
        }
    }

    static async me () {
        try {
            return await AuthRepository.me()
        } catch (error) {
            console.error('Auth check error:', error);
            return { ok: false };
        }
    }

    static async logout () {
        Auth.token = ''
        // return await AuthRepository.logout()
    }
}

export default Auth