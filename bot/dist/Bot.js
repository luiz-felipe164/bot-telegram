"use strict";
Object.defineProperty(exports, "__esModule", { value: true });
exports.Bot = void 0;
var telegraf_1 = require("telegraf");
var Bot = /** @class */ (function () {
    function Bot(bot, token) {
        this.bot = bot;
        this.token = token;
        bot = new telegraf_1.Telegraf(token);
    }
    Bot.prototype.listener = function () {
        this.bot.on('message', function (ctx) {
            // Explicit usage
            // ctx.telegram.sendMessage(ctx.message.chat.id, `Hello ${ctx.state.role}`)
            console.log(ctx.message);
            // Using context shortcut
            ctx.reply("Reply: Mensagem recebida");
        });
    };
    Bot.prototype.launch = function () {
        var _this = this;
        this.bot.launch();
        // Enable graceful stop
        process.once('SIGINT', function () { return _this.bot.stop('SIGINT'); });
        process.once('SIGTERM', function () { return _this.bot.stop('SIGTERM'); });
    };
    return Bot;
}());
exports.Bot = Bot;
