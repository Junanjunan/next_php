"use client";

import axios from "axios";
import Cookies from 'js-cookie';

export default function Logout() {
  const session_id = Cookies.get('PHPSESSID');

  async function logout () {
    try{
      const res = await axios.post('http://localhost/logout_next.php', {}, {
        withCredentials: true,
      });
    } catch (error) {
      console.error('Error fetching profile:', error);
      throw new Error('Failed to fetch profile');
    }
  }
  return (
    <div>
      <h2>Logout</h2>
      <button onClick={logout}>Logout</button>
    </div>
  );
}