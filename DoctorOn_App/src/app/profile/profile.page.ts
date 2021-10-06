import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import { AlertController, LoadingController, ToastController } from '@ionic/angular';
import { Observable } from 'rxjs';
import { AuthService } from '../services/auth.service';
import { map, tap } from 'rxjs/operators';
import { HttpClient } from '@angular/common/http';
@Component({
  selector: 'app-profile',
  templateUrl: './profile.page.html',
  styleUrls: ['./profile.page.scss'],
})
export class ProfilePage implements OnInit {
  user: any = [];

  constructor(
    private authService: AuthService,
    private loadingCtrl: LoadingController,
    private alertCtrl: AlertController,
    private toastCtrl: ToastController,
    private router: Router,
    public http: HttpClient
  ) { }

  async ngOnInit() {

    const loading = await this.loadingCtrl.create({ message: 'Carregando...' });
    loading.present();

    this.authService.profile().subscribe(
      async users => {
        this.user = users['user'];
        loading.dismiss();
        console.log(this.user);
      },
      async error => {
        const alert = await this.alertCtrl.create({
          header: 'Falha',
          message: error.error.message,
          buttons: [{
            text: 'OK',
            handler: () => { this.router.navigateByUrl('/login') }
          }],
        });
        loading.dismiss();
        await alert.present();
        console.log(error.error);
      }
    )
  }

}
