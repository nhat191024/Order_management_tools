import { api } from "./api";

export async function loginHandle(username, password) {
    try {
        let date = new Date();
        const expires = new Date(date.getTime() + 2 * 60 * 60 * 1000);
        const response = await api.post('/login', {
            username: username,
            password: password
        });
        if (response.data.data.message == 'Login Success') {
            console.log(response.data.data.id);
            document.cookie = `Token=${response.data.data.token}; expires=${expires.toUTCString}; path=/`;
            document.cookie = `Role=${response.data.data.role}; expires=${expires.toUTCString}; path=/`;
            document.cookie = `Id=${response.data.data.id}; expires=${expires.toUTCString}; path=/`;
            document.cookie = `Branch_id=${response.data.data.branch_id}; expires=${expires.toUTCString}; path=/`;
            return 'success';
        }
    } catch (err) {
        if (err.response.status === 401) {
            return 'fail';
        }
    }
}

export async function logout() {
    try {
        const response = await api.post('/logout');
        if (response.data.Message == 'logout success') {
            localStorage.removeItem('Token');
            document.cookie = `Role=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/`;
            document.cookie = `Id=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/`;
            return 'success';
        }
    } catch (err) { }

}