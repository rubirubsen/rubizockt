require('dotenv').config();
let socketClient;
const tmi = require('tmi.js');
const fetch = require('node-fetch');
const helper = require('./helper.js');
const username = process.env.TWITCHBOTUSER;
const password = process.env.TWITCHBOTPW;
const clientID = process.env.CLIENTID;
const clientSecret = process.env.CLIENTSECRET;
const WebSocket = require('ws');
const wss = new WebSocket.Server({port:8123});

wss.on('connection', ws =>{
    console.log('Neue Websock-Verbindung hergestellt');
    socketClient = ws;

    ws.on('close', () => {
        console.log('WebSocket-Verbindung geschlossen');
        socketClient = null;
    });
});

let bearT = '';

//KONFIGURATION
const twitchConfig = {
  options: {
    debug: true // Set this to false for production
  },
  connection: {
    reconnect: true
  },
  identity: {
    username: username,
    password: password
  },
  channels: ['rubizockt','derhamsta']
};

//CLIENT ERSTELLEN
const client = new tmi.client(twitchConfig);


//EVENT->VERBINDUNG
client.on('connected', (address, port) => {
  console.log(`Connected to ${address}:${port}`);
});

//EVENT-HANDLER FÜR NACHRICHTEN
client.on('chat', (channel, user, message, self) => {

    if (self) return; // Ignore messages from the bot itself

    if (message.startsWith('!')) {

        let args = message.split(' ');
        const command = args[0];
        
        if (command === '!hellobot') {
            const response = `Hi ${user.username}, ich bin bereit!`;
            if (socketClient) {
                    socketClient.send('Bot wurde via !hellobot gerufen');
            }
            client.say(channel, response);
        };

        if (command === '!so') {
            let shoutName = args[1];
            const response = `${user.username}, sendet einen ShoutOut an ${shoutName}. Besucht ihn unter https://www.twitch.tv/`+shoutName;
            if (socketClient) {
                socketClient.send('Shoutout an '+shoutName);
            }
            client.say(channel, response);
        };

        if (command === '!slap') {
          let verb = ['schlägt', 'haut', 'slapt', 'trifft', 'scheppert'];
          let fisch = ['Forelle', 'Hering', 'Guppi', 'Goldfisch', 'Sprotte', 'Lachs', 'Wal', 'Delphin', 'Kugelfisch'];
        
          // Generate random indices for verb and fisch arrays
          const verbIndex = helper.randomNumber(verb.length);
          const fischIndex = helper.randomNumber(fisch.length);
        
          const response = `${user.username} ${verb[verbIndex]} ${args[1]} mit ${fisch[fischIndex]}.`;
            if (socketClient) {
                socketClient.send(response);
            }
          client.say(channel, response);
        }

        if (command === '!followage'){
          helper.getTwitchBearerToken(user.username).then(data => {
            bearT =  data.bearerToken;
            helper.getUserInfo(clientID, bearT, data.username).then(userData =>{
              helper.getFollowDate(userData.clientId, userData.accessToken, userData.userId).then(data =>{
                  const followedDate = new Date(data.followDate);
                  const formattedDate = followedDate.toLocaleDateString('de-DE');
                  let response = 'Du folgst seit: ';
                  response = response+formattedDate;
                  if (socketClient) {
                      socketClient.send(response);
                  }
                  client.say(channel, response);
              });
            });

        }).catch(error => {
          console.error('Error:', error);
        });
        }
    };
    if (socketClient) {
        socketClient.send(`#${channel} : ${user.username}: ${message}`);
    }
    });

//VERBINDUNG
client.connect();

