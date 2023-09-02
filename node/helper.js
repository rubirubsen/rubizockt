

const randomNumber = function(maxVal) {
    // Generate a random decimal between 0 and 1
    var randomDecimal = Math.random();
    // Scale the random decimal to the desired range
    var randomInteger = Math.floor(randomDecimal * maxVal) + 1;
    return randomInteger;
}

const getUserInfo = function(clientId, accessToken, userLogin) {
    const url = `https://api.twitch.tv/helix/users?login=${userLogin}`;

    const headers = new Headers();
    headers.append('Client-ID', clientId);
    headers.append('Authorization', `Bearer ${accessToken}`);

    const requestOptions = {
        method: 'GET',
        headers: headers,
    };
    return fetch(url, requestOptions)
        .then(response => response.json())
        .then(data => {
            const creationDate = data.data[0].created_at;
            const userId = data.data[0].id;
            return { clientId, accessToken, userId, userLogin, creationDate };
        });
}

const getFollowDate = async function(clientId, accessToken, fromId){
    const url = `https://api.twitch.tv/helix/users/follows?from_id=${fromId}&to_id=27766960`;
    /*TODO: to_id dynamisieren!*/
    const headers = new Headers();
    headers.append('Client-ID', clientId);
    headers.append('Authorization', `Bearer ${accessToken}`);

    const requestOptions = {
        method: 'GET',
        headers: headers,
    };

    return fetch(url, requestOptions)
        .then(response => response.json())
        .then(data => {
            followDate = data.data[0].followed_at;
            return { followDate };
        });
}

const getTwitchBearerToken = async function(username) {
    const clientId = process.env.CLIENTID;
    const clientSecret = process.env.CLIENTSECRET;
    try {
        const response = await fetch('https://id.twitch.tv/oauth2/token', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: new URLSearchParams({
                client_id: process.env.CLIENTID,
                client_secret: process.env.CLIENTSECRET,
                grant_type: 'client_credentials',
            }),
        });

        const data = await response.json();
        const bT = data.access_token;
        return { 'username':username,
            'bearerToken':bT };
    } catch (error) {
        console.log('Error:', error);
        return null;
    }
}

module.exports = {randomNumber,getUserInfo,getFollowDate, getTwitchBearerToken};
