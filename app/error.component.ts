import { Component } from '@angular/core';

@Component({
    selector: 'error',
    templateUrl: 'error.component.html',
    providers: [ErrorComponent]
})
export class ErrorComponent {
    private errorMessage: string;
    private errorCode: number;

    public setError(message: string, code: number = null) {
        this.errorMessage = message;
        this.errorCode = code;
    }
}