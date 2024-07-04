import axios from 'axios';
import { cookies } from 'next/headers';
import { redirect } from 'next/navigation';

async function getProfileData(mb_id) {
  const cookieStore = cookies();
  try {
    const response = await axios.get(`http://localhost/profile/${mb_id}`, {
      headers: {
        'Cookie': cookieStore.toString(),
      },
      withCredentials: true,
      validateStatus: function (status) {
        return true; // 모든 상태 코드에 대해 promise resolve
      },
    });

    if (!response.data) {
      throw new Error('No data received');
    }

    return response.data;
  } catch (error) {
    console.error('Error fetching profile:', error);
    throw new Error('Failed to fetch profile');
  }
}

async function ProfilePage({ params }) {
  const { mb_id } = params;

  try {
    const response = await getProfileData(mb_id);

    if (!response.success) {
      redirect('/login');
    }

    return (
      <div>
        <h1>Welcome to your profile, {response.mb_id}!</h1>
        <p>Session ID: {response.cookie}</p>
      </div>
    );
  } catch (error) {
    console.error('An error occurred while fetching profile:', error);
    redirect('/login');
  }
}

export default ProfilePage;
