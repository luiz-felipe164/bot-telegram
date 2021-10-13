
import { PubsubManager } from 'redis-messaging-manager';

export class Publisher {

  constructor(
    private pub: PubsubManager = new PubsubManager({
      host: 'redis',
      port: 6379
    })
  ) { }

  publish(channel: string, message: string): Promise<Number> {
    return this.pub.publish(channel, message);
  }
}