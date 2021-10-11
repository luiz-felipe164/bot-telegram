FROM node:12-alpine

WORKDIR /home/node/app

ADD . .

ENV NODE_ENV=production

RUN npm ci

USER node

EXPOSE 8080

CMD [ "node", "build/index.js" ]