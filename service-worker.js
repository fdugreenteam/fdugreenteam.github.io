!function(){"use strict";const e=["client/chunk.4869d84b.js","client/client.94a03a39.js","client/chunk.885cfde2.js","client/chunk.3f2b207b.js","client/chunk.5efed930.js","client/chunk.a1b8b347.js","client/chunk.b51bf057.js","client/chunk.e7b1d841.js","client/chunk.99f0c914.js","client/chunk.fd83dea4.js","client/chunk.b8490da7.js","client/chunk.cfc9c889.js"].concat(["/service-worker-index.html","favicon.ico","global.css","images/1.jpg","images/benzecry.jpg","images/clarke.jpg","images/earthday.jpeg","images/green_team_orgfair_2016.jpeg","images/greenhouse_dr.b&son.jpeg","images/greenhouse_dr.b.jpeg","images/issa.jpg","images/johnny.png","images/melendez.png","images/morgan.jpeg","images/posters/2016/1_earth_day.jpg","images/posters/2016/2_earth_day.jpg","images/posters/2016/3_earth_day.jpg","images/posters/2016/4_earth_day.jpg","images/posters/2016/5_earth_day.jpg","images/posters/2016/6_earth_day.jpg","images/posters/2016/7_earth_day.jpg","images/posters/2016/earth_day.jpg","images/posters/2016/earth_day.xcf","images/quashon.jpg","images/sanih.jpg","images/scratch_off_winner.jpeg","images/shaka.jpeg","images/valentines.jpg"]),s=new Set(e);self.addEventListener("install",s=>{s.waitUntil(caches.open("cache1554767218170").then(s=>s.addAll(e)).then(()=>{self.skipWaiting()}))}),self.addEventListener("activate",e=>{e.waitUntil(caches.keys().then(async e=>{for(const s of e)"cache1554767218170"!==s&&await caches.delete(s);self.clients.claim()}))}),self.addEventListener("fetch",e=>{if("GET"!==e.request.method||e.request.headers.has("range"))return;const a=new URL(e.request.url);a.protocol.startsWith("http")&&(a.hostname===self.location.hostname&&a.port!==self.location.port||(a.host===self.location.host&&s.has(a.pathname)?e.respondWith(caches.match(e.request)):"only-if-cached"!==e.request.cache&&e.respondWith(caches.open("offline1554767218170").then(async s=>{try{const a=await fetch(e.request);return s.put(e.request,a.clone()),a}catch(a){const t=await s.match(e.request);if(t)return t;throw a}}))))})}();
