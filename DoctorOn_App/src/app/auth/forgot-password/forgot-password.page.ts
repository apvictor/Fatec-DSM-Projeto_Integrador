import { Component, OnInit } from '@angular/core';
import { FormControl, FormGroup, Validators } from '@angular/forms';
import { Router } from '@angular/router';
import { AlertController, LoadingController, ToastController } from '@ionic/angular';
import { AuthService } from 'src/app/services/auth.service';

@Component({
  selector: 'app-forgot-password',
  templateUrl: './forgot-password.page.html',
  styleUrls: ['./forgot-password.page.scss'],
})
export class ForgotPasswordPage implements OnInit {

  constructor(
    private authService: AuthService,
    private loadingCtrl: LoadingController,
    private alertCtrl: AlertController,
    private toastCtrl: ToastController,
    private router: Router,
  ) { }

  form = new FormGroup({
    email: new FormControl('', Validators.compose([Validators.required, Validators.pattern('^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+.[a-zA-Z0-9-.]+$')])),
    password: new FormControl('', Validators.compose([Validators.required])),
  });


  ngOnInit() {
    localStorage.getItem('token');
    localStorage.clear();
  }

  async forgotPassword() {
    const loading = await this.loadingCtrl.create({ message: 'Redefinindo...' });
    await loading.present();

    this.authService.forgotPassword(this.form.value).subscribe(
      async success => {
        loading.dismiss();
        const alert = await this.alertCtrl.create({
          header: 'Senha redefinida',
          message: 'Senha alterada com sucesso!',
          buttons: [{
            text: 'OK',
            handler: () => { this.router.navigateByUrl('/login'); }
          }]
        });
        await alert.present();
        console.log(success);
      },
      async error => {
        const alert = await this.alertCtrl.create({
          header: 'Falha ao redefinir senha',
          message: error.error.msg,
          buttons: ['OK']
        });
        loading.dismiss();
        await alert.present();
        console.log(error.error);
      }
    )
  }



}
