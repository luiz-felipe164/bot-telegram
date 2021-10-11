import { Telegraf } from 'telegraf'
import { config } from 'dotenv';
import { PubSubRedis } from './services/pubsub-redis';

config();

const key = process.env.BOT_KEY ?? ''

const bot = new Telegraf(key);

bot.on('message', async (ctx) => {
    console.log(ctx.message)

    // Using context shortcut
    ctx.reply('Reply: Mensagem recebida')
})

bot.launch()
