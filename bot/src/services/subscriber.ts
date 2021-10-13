import { PubsubManager } from "redis-messaging-manager";

export class Subscriber {

    constructor(
        private sub: PubsubManager = new PubsubManager({
          host: 'redis',
          port: 6379
        })
      ) { }

    subscribe(): PubsubManager {
        return this.sub;
    }
}