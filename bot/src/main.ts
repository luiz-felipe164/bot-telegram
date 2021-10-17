import { config } from 'dotenv';
import { Publisher } from './services/publisher';
import { Subscriber } from './services/subscriber';
import { Bot } from './services/bot';

config();

// const key = process.env.BOT_KEY || '';
// const bot: Telegraf = new Telegraf(key);
// const bot: Bot = new Bot(key);
// const pub: Publisher = new Publisher();
// const sub: Subscriber = new Subscriber();

enum Messages {
    END_MESSAGE = 'Conversa finalizada',
    REPLY = 'Reply: Mensagem Recebida',
    ERROR = 'Ocorreu um erro inesperado, por favor tente novamente!'
}

class MainBot {
    
    constructor(
        private bot: Bot,
        private pub: Publisher = new Publisher(),
        private sub: Subscriber = new Subscriber(),
        private channel_sub: string,
        private channel_pub: string
    ){}

    init(): void {
        this.subscribe()
        this.listenNemMessage()
        this.bot.launch()
    }


    private subscribe(): void {
        this.sub.subscribe().consume(this.channel_sub)
            .subscribe(msg => {
                const json = JSON.parse(msg)
                if (json.id) {
                    this.bot.sendMessage(json.id, Messages.END_MESSAGE)
                }
            });
    }

    private listenNemMessage(){
        this.bot.instance().on('message', async (ctx) => {
            const message: string = JSON.stringify(ctx.message)
            const response = await this.pub.publish(this.channel_pub, message)
            console.log(message)

            if (response > 0) {
                ctx.reply(Messages.REPLY)
            } else {
                ctx.reply(Messages.ERROR)
            }
        })
    }
}

const pub = new Publisher()
const sub = new Subscriber()
const bot = new Bot(process.env.BOT_KEY || '')

const mainBot = new MainBot(bot, pub, sub, 'end_chat', 'new_message')
mainBot.init()
