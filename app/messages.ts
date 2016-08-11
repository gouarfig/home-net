
export class Messages {
    public information: string = "";
    public warning: string = "";
    public error: string = "";

    public clear() {
        this.error = "";
        this.warning = "";
        this.information = "";
    }
}
