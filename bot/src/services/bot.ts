import { Telegraf } from "telegraf";

export class Bot {
    private bot: Telegraf

    constructor(key: string){
        this.bot = new Telegraf(key);
    }

    instance(){
        return this.bot
    }

    sendMessage(chat_id: number | string, message: string){
        this.bot.telegram
            .sendMessage(chat_id, message)
            .catch(error => console.log(error))
    }

    launch(){
        this.bot.launch()
    }
}