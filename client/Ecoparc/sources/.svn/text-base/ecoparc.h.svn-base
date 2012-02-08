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

#ifndef ECOPARC_H
#define ECOPARC_H

#include <QWidget>
#include <QMenu>
#include <QMessageBox>
#include <QNetworkReply>
#include <QTimer>
#include <QSettings>
#include <QByteArray>
#include <QDebug>
#include <QSslConfiguration>
#include <QPointer>
#include <QSystemTrayIcon>
#include "os.h"

#define MESSAGE_NODE "message"
#define EXECUTE_MSG_MESSAGE_ATTRIBUTE "executedMsgID"
#define RESULT_BOOL_MESSAGE_ATTRIBUTE "resultBool"
#define RESULT_DESCRIPTION_MESSAGE_ATTRIBUTE "resultDescription"
#define TIME_NEXT_REQUEST_ATTRIBUTE "nextRequest"
#define MODE_SERVER "auditMode"

#define MAC_NODE_NAME "MACAddress"
#define IP_NODE_NAME "IPAddress"

namespace Ui {
class Ecoparc;
}


class Ecoparc : public QWidget
{
    Q_OBJECT
    Q_ENUMS(MessageType)
    Q_ENUMS(ModeType)

    QMenu *trayIconMenu;

public:
    explicit Ecoparc(QWidget *parent = 0);
    ~Ecoparc();
    void osType();
    OS *currentOS;
    enum MessageType {
        MessageError = 0,
        MessageAuthentification = 1,
        MessageStatus= 2,
        MessageReport = 3,
        MessageNothing = 4
    };
    enum ModeType {
        ModeAudit = 1,
        ModeReporting
    };

    QSystemTrayIcon *trayIcon;
    void requestResult(MessageType type, bool isSucced,
                       QString message, int timeNextRequest,
                       bool auditMode);

private:
    void doRequest(MessageType type);
    void statusRequest();
    void showMessageBox();
    void createTrayIcon();
    void updateTrayIconToolTips(QString message, bool everythingIsOk);
    void updateSysTray(QString title, QString body, QString toolTipMsg,
                       QSystemTrayIcon::MessageIcon iconType, int time);
    void createActions();

    int connectionStatus;
    int ecoparcMode;
    int lastMessageType;
    QNetworkReply *currentReply;
    Ui::Ecoparc *ui;
    QTimer *iTimer;
    QPointer<QNetworkAccessManager> _qnam;
    QNetworkAccessManager* createQNAM();
    QAction *settingAction;
    QAction *quitAction;
    QAction *aboutAction;
    QAction *aboutQTAction;
    QAction *ecoparcStatusQTAction;

private slots:
    void on_saveButton_clicked();
    void finished(QNetworkReply* reply);
    void timeOutGetSatus();
    void sslErrors ( QNetworkReply * reply, const QList<QSslError> & errors );
    void iconActivated(QSystemTrayIcon::ActivationReason reason);
    void showInformation();
    void showSettings();
    void showAboutEcoparc();
    void showAboutQT();
};

#endif // ECOPARC_H
