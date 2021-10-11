import { PubSub } from "../intefarces/pub-sub-interface";
import { createClient } from 'redis';

export class PubSubRedis implements PubSub {

  constructor(
    private redis = createClient({
      host: 'redis',
      port: 6379,
      password: ''
    })
  ) { }

  publish() {

  }

  subscribe() {
    this.redis.on('message', function (channel: unknown, message: unknown) {
      console.log('Message: ' + message + ' on channel: ' + channel + ' is arrive!');
    });
    this.redis.subscribe('notification');
  }
}