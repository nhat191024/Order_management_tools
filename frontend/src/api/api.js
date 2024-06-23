import axios from "axios";

const token = document.cookie.split(';').find(cookie => cookie.includes('Token')).split('=')[1];

export const api = axios.create({
  baseURL: "http://127.0.0.1:8000/api/",
  headers: {
    Authorization: `Bearer ${token}`,
    "Content-Type": "application/json",
    Accept: "application/json",
  },
});
