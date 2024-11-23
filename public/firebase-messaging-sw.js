// firebase-messaging-sw.js

// This is a minimal file to allow Firebase messaging to function
    importScripts('https://www.gstatic.com/firebasejs/11.0.1/firebase-app.js');
    importScripts('https://www.gstatic.com/firebasejs/11.0.1/firebase-messaging.js');

firebase.initializeApp({
    apiKey: "AIzaSyCsSc2EP5fWZAinxjRVHzHK33jvvTyQQuc",
    authDomain: "test-firebase-project-edf39.firebaseapp.com",
    projectId: "test-firebase-project-edf39",
    storageBucket: "test-firebase-project-edf39.firebasestorage.app",
    messagingSenderId: "77867075323",
    appId: "1:77867075323:web:3fe706e76ec18f1d9b925e",
});

// Handle background messages
const messaging = firebase.messaging();
messaging.onBackgroundMessage(function (payload) {
    console.log('[firebase-messaging-sw.js] Received background message:', payload);

    const notificationTitle = payload.notification.title || 'Default Title';
    const notificationOptions = {
        body: payload.notification.body || 'Default body message.',
        icon: payload.notification.icon || '/firebase-logo.png',
    };

    return self.registration.showNotification(notificationTitle, notificationOptions);
});
