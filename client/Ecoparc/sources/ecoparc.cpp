// This file is part of Ecoparc project.
//
// Ecoparc project is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Ecoparc project is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Ecoparc project.  If not, see <http://www.gnu.org/licenses/>.
//

#include <QDesktopWidget>
#include <QTextDocument>
#include "xmlparsing.h"
#include "ecoparc.h"
#include "ui_ecoparc.h"
#include "wmac.h"
#include "wwindows.h"
#include "wlinux.h"
#include "sysinfo.h"
#include "xmlformat.h"

#define TIME_POP_UP_SYSTRAY_ERROR 2500
#define TIME_POP_UP_SYSTRAY_INFO 2500
int timeout;
bool autoClose;
int currentTime;



Ecoparc::Ecoparc(QWidget *parent) :
    QWidget(parent),
    ui(new Ui::Ecoparc)
{
    ui->setupUi(this);
    Ecoparc::osType();
    _qnam = createQNAM();
    this->currentOS->initialize();
    createTrayIcon();
    connect(trayIcon, SIGNAL(messageClicked()), this, SLOT(showInformation()));
    connect(trayIcon, SIGNAL(activated(QSystemTrayIcon::ActivationReason)),
            this, SLOT(iconActivated(QSystemTrayIcon::ActivationReason)));
    trayIcon->show();
    QSettings settings;
    ui->lineEdit->setText(settings.value(QString("ip-server")).toString());
    this->doRequest(MessageAuthentification);
}

Ecoparc::~Ecoparc()
{
    if(_qnam) {
        _qnam->deleteLater();
    }
    delete ui;
}

QNetworkAccessManager* Ecoparc::createQNAM() {
    QNetworkAccessManager* qnam = new QNetworkAccessManager(this);
    /* We'll handle the finished reply in replyFinished */
    connect(qnam, SIGNAL(finished(QNetworkReply*)),
            this, SLOT(finished(QNetworkReply*)));
    return qnam;
}

void Ecoparc::doRequest(MessageType type) {
    qDebug() << "launch request = " + QString::number(type);
    QSettings settings;
    const QUrl url = QUrl(settings.value(QString("ip-server")).toString());
    const QNetworkRequest request(url);
    QString donnees;
    donnees = xmlformat().messageType(type);
    qDebug() << "donnes = " + donnees;

    QString  stringEncode = QUrl::toPercentEncoding(donnees.toAscii());
    QByteArray dataByte = QString("message=").toLatin1()+ stringEncode.toLatin1();
    currentReply = _qnam->post(request, dataByte);
    currentReply->ignoreSslErrors();
}

void Ecoparc::finished(QNetworkReply* reply)
{
    qDebug() << "Ecoparc::finished request";
    if (reply->error() == QNetworkReply::NoError)
    {
        QString string(reply->readAll()); // string
        qDebug() <<  "data =" << string;
        XMLParsing(this).parseMessage(&string);
        //updateTrayIconToolTips(QString(tr("Connecter a ecoparc")), true);
    }
    else {
        qDebug() << "Ecoparc::finished - erreur" << reply->errorString();
        updateSysTray(QString(tr("Ecoparc")), QString(tr("Verifier que les parametres de votre server sont correct sur le client ou contacter votre administrateur reseau\nerreur: "))+ reply->errorString(), QString(tr("erreur de connection")), QSystemTrayIcon::Critical, TIME_POP_UP_SYSTRAY_ERROR);
        updateTrayIconToolTips(QString(tr("connection error")), false);
    }
}

void Ecoparc::requestResult(MessageType type,
                            bool isSucced,
                            QString message,
                            int timeNextRequest,
                            bool auditMode) {
    qDebug() << "Ecoparc:: analyse request result type ="+ QString::number(type);
    if (type == MessageError) {
        qDebug() << "MessageAuthentification == bad";
        ui->labelAuthentificated->setText(QString("No"));
        ui->labelModeEcoparc->setText(QString(tr("erreur de communication\n")) + message);
        updateSysTray(QString(tr("Ecoparc")), QString(tr("Erreur d'authentification\n")) + message, QString(tr("Erreur d'authentification")), QSystemTrayIcon::Critical, TIME_POP_UP_SYSTRAY_ERROR);
        updateTrayIconToolTips(QString(tr("connection error ")) +message, false);
    }
    else if (type == MessageAuthentification) {
        qDebug() << message;
          qDebug() << "(type == MessageAuthentification";
        if (isSucced || message == "Execution failed : IP Address or Mac Address already registered in database") {
            this->doRequest(MessageStatus);
            ui->labelAuthentificated->setText(QString("Yes"));
            updateTrayIconToolTips(QString(tr("authentificated")), true);
        }
        else {
            qDebug() << "MessageAuthentification == bad";
            ui->labelAuthentificated->setText(QString("No"));
            ui->labelModeEcoparc->setText(QString(tr("erreur de communication\n")) + message);
            updateSysTray(QString(tr("Ecoparc")), QString(tr("Erreur d'authentification\n")) + message, QString(tr("Erreur d'authentification")), QSystemTrayIcon::Critical, TIME_POP_UP_SYSTRAY_ERROR);
            updateTrayIconToolTips(QString(tr("connection error ")) +message, false);
        }
    }
    else if (type == MessageStatus) {
        qDebug() << "type == MessageStatus";
        if (isSucced) {
           qDebug() << "(type == MessageStatu goodh  ";
            ui->labelCommand->setText(message);
            if (!auditMode){
                qDebug() << "reporting mode";
                ui->labelModeEcoparc->setText(QString(tr("reporting")));
                ecoparcMode = ModeReporting;
            }
            else{
                qDebug() << "audit mode";
                ui->labelModeEcoparc->setText(QString(tr("audit")));
                ecoparcMode = ModeAudit;
            }
            if (message == "nothing") {
                ui->labelNextRequest->setText(QString::number(timeNextRequest) + " min.");
                iTimer = new QTimer(this);
                iTimer->setInterval(timeNextRequest* 60 * 1000);
                iTimer->start();
                connect(iTimer, SIGNAL(timeout()), this, SLOT(timeOutGetSatus()));
            }
            else if (message == "sleep"){
                this->currentOS->askForSleep();
                updateSysTray(QString(tr("Ecoparc")), QString(tr("Attention votre ordinateur va ce mettre en veille")) + message,
                              QString(tr("mise en veille")), QSystemTrayIcon::Information, TIME_POP_UP_SYSTRAY_INFO);
                updateTrayIconToolTips(QString(tr("mise en veille")), true);
            }
            else if (message == "poweroff"){
                this->currentOS->askForShutDown();
                updateSysTray(QString(tr("Ecoparc")), QString(tr("Attention votre ordinateur va s'eteindre")) + message,
                              QString(tr("extinction")), QSystemTrayIcon::Information, TIME_POP_UP_SYSTRAY_INFO);
                updateTrayIconToolTips(QString(tr("extinction")), true);
            }
            else {
                 ui->labelModeEcoparc->setText(QString(tr("erreur de communication\n")) + message);
                updateSysTray(QString(tr("Ecoparc")), QString(tr("Erreur de communication\n")) + message,
                              QString(tr("Erreur de communication")), QSystemTrayIcon::Critical, TIME_POP_UP_SYSTRAY_ERROR);
                updateTrayIconToolTips(QString(tr("connection error")), false);
            }
        }
        else {

            ui->labelModeEcoparc->setText(QString(tr("erreur de communication\n")) + message);
            updateSysTray(QString(tr("Ecoparc")), QString(tr("Erreur de communication\n")) + message,
                          QString(tr("Erreur de communication")), QSystemTrayIcon::Critical, TIME_POP_UP_SYSTRAY_ERROR);
            updateTrayIconToolTips(QString(tr("Erreur de communication ")) + message , false);
        }
    }
}

void Ecoparc::osType()
{
#if defined(Q_OS_WIN)
    this->currentOS = new wwindows();
#elif defined(Q_OS_MAC)
    this->currentOS = new wmac();
#elif defined(Q_OS_LINUX)
    this->currentOS = new wlinux();
#else
    return ;
#endif
}

void Ecoparc::on_saveButton_clicked()
{

   QSettings settings;
    settings.setValue(QString("ip-server"), ui->lineEdit->text());
    currentReply->abort();
    this->doRequest(MessageAuthentification);
}

void Ecoparc::sslErrors ( QNetworkReply * reply,
                          const QList<QSslError> & errors ) {
    qDebug() << "sslErrors "+ reply->errorString() << errors.first();
}

void Ecoparc::timeOutGetSatus() {
    qDebug() << "timeOutGetSatus";
    iTimer->stop();
    iTimer->deleteLater();
    this->doRequest(MessageStatus);
}

void Ecoparc::iconActivated(QSystemTrayIcon::ActivationReason reason) {
    switch (reason) {
    case QSystemTrayIcon::Trigger:
        break;
    case QSystemTrayIcon::DoubleClick:
        qDebug() << "DoubleClick";
        showInformation();
        break;
    case QSystemTrayIcon::MiddleClick:
        showInformation();
        break;
    default:
        ;
    }
}

void Ecoparc::updateSysTray(QString title,
                            QString body,
                            QString toolTipMsg,
                            QSystemTrayIcon::MessageIcon iconType,
                            int time)
{
    ecoparcStatusQTAction->setText(toolTipMsg);
    trayIcon->showMessage(title, body, iconType, time);
}

void Ecoparc::showInformation() {
    QString mode = QString();
    if (ecoparcMode && ecoparcMode == ModeReporting )
        mode = QString(tr("\nmode: ")) + QString(tr("reporting"));
    else if (ecoparcMode && ecoparcMode == ModeAudit )
        mode = QString(tr("\nmode: ")) + QString(tr("audit"));
    trayIcon->showMessage(QString(tr("Ecoparc")), mode,  QSystemTrayIcon::Information);
}

void Ecoparc::updateTrayIconToolTips(QString message, bool everythingIsOk) {

    if (everythingIsOk)
    qDebug() << "updateTrayIconToolTips is ok ";
    else
            qDebug() << "updateTrayIconToolTips is bad ";

    trayIcon->setToolTip(message);
    ecoparcStatusQTAction->setText(QString(tr("Status: "))+message);
    trayIcon->setIcon(everythingIsOk ? QIcon(":/images/icon.png")
                                        :QIcon(":/images/icon_bad.png"));
}

void Ecoparc::showSettings() {
    activateWindow();
    QRect desktopRect = QApplication::desktop()->availableGeometry(this);
    this->move(desktopRect.center() - rect().center());
    //showMaximized();
    this->setWindowFlags(Qt::WindowStaysOnTopHint);
    show();
}

const char *fr_about =
        "<HTML>"
        "<p><b>Ecoparc est un projet r&eacute;alis&eacute; par 8 &eacute;l&egrave;ves de l&acute;Epitech dans le cadre de leur projet de fin d&acute;&eacute;tude ou EIP (Epitech Innovative Project).</b></p>"
        "<li>version: 0.9</li>"
        "<li>licence: <A HREF=\"http://gnu.org/licenses/gpl.html\">GNU GPL v3</A></li>"
        "<br/>"
        "<li><A HREF=\"http://eip.epitech.eu/2012/ecoparc/\">http://eip.epitech.eu/2012/ecoparc/</A></li>"        
        "<li>contactez nous:</li>"
        "<li><A HREF=\"mailto:ecoparc_2012@labeip.epitech.eu\">ecoparc_2012@labeip.epitech.eu</A></li>"
        "</HTML>";

const char *en_about =
        "<HTML>"
        "<p><b>Ecoparc is a project made by 8 students of Epitech as part of their final assignment or EIP (Epitech Innovative Project).</b></p>"
        "<li>version: 0.9</li>"
        "<li>licence: <A HREF=\"http://gnu.org/licenses/gpl.html\">GNU GPL v3</A></li>"
        "<br/>"
        "<A HREF=\"http://eip.epitech.eu/2012/ecoparc/\">http://eip.epitech.eu/2012/ecoparc/</A>"
        "<li>Contact us:</li>"
        "<A HREF=\"mailto:ecoparc_2012@labeip.epitech.eu\">ecoparc_2012@labeip.epitech.eu</A>"
        "</HTML>";

void Ecoparc::showAboutEcoparc() {
    QString locale = QLocale::system().name().section('_', 0, 0);
    QMessageBox::about(this, "About Ecoparc", QString(locale == QString("fr") ? fr_about : en_about));
}
void Ecoparc::showAboutQT() {
    QMessageBox::aboutQt (this, QString("About QT"));
}

void Ecoparc::createActions() {
    ecoparcStatusQTAction = new QAction(tr("Status:"), this);

    settingAction = new QAction(tr("Preferences"), this);
    connect(settingAction , SIGNAL(triggered()), this, SLOT(showSettings()));

    aboutAction = new QAction(tr("A propos"), this);
    connect(aboutAction, SIGNAL(triggered()), this, SLOT(showAboutEcoparc()));

    aboutQTAction = new QAction(tr("A propos QT"), this);
    connect(aboutQTAction , SIGNAL(triggered()), this, SLOT(showAboutQT()));

    quitAction = new QAction(tr("Quit"), this);
    connect(quitAction, SIGNAL(triggered()), qApp, SLOT(quit()));
}


void Ecoparc::createTrayIcon() {
    this->createActions();
    trayIcon = new QSystemTrayIcon(this);
    QIcon icon;
    icon = QIcon(":/images/icon.png");
    trayIcon->setIcon(icon);
    this->updateTrayIconToolTips(tr("launch"), true);

    setWindowIcon(icon);
    trayIconMenu = new QMenu(this);

    trayIconMenu->addAction(ecoparcStatusQTAction);
    trayIconMenu->addAction(settingAction);
    trayIconMenu->addSeparator();
    trayIconMenu->addAction(aboutAction);
    trayIconMenu->addAction(aboutQTAction);
    trayIconMenu->addSeparator();
    trayIconMenu->addAction(quitAction);
    trayIcon->setContextMenu(trayIconMenu);
}
