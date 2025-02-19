importScripts('https://www.gstatic.com/firebasejs/8.3.2/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/8.3.2/firebase-messaging.js');

firebase.initializeApp({
    apiKey: "AIzaSyDuuEKeEhmWz_OPCsCk1HPgHerQscb6aV0",
    projectId: "dukkan-store",
    messagingSenderId: "62621274937",
    appId: "1:62621274937:web:3c82fe1845bd2b486bcee8"
});

const messaging = firebase.messaging();
messaging.setBackgroundMessageHandler(function ({data: {title, body, icon}}) {
    return self.registration.showNotification(title, {body, icon});
});
