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

#include "os.h"
#include <QDebug>
#include <QTimer>
#include <QMessageBox>
#include <QPushButton>
#include <QTranslator>

#define POP_UP_TIMER 60

OS::OS()
{
}

void OS::shutdown()  {
   qDebug() << "shutdown OS:";
}

void OS::sleep()  {
   qDebug() << "sleep OS:";
}

void OS::initialize() {
    qDebug() << "initialize() OS:";
    QTimer *timerr = new QTimer(this);
    timerr->setInterval(1);
    connect(timerr, SIGNAL(timeout()), this, SLOT(timeOutShutdownTimer()));
    timerr->start();
}

void OS::askForShutDown() {
    qDebug() << "askForShutDown";

    QTimer * timer = new QTimer(this);
    timer->setInterval(POP_UP_TIMER * 1000 );
    timer->start();
    connect(timer, SIGNAL(timeout()), this, SLOT(timeOutShutdownTimer()));

    QMessageBox msgBox;
    msgBox.setIcon(QMessageBox::Warning);
    msgBox.setText(tr("Votre ordinateur va s'eteindre"));
    msgBox.setInformativeText(tr("votre ordinateur va s'eteindre, voulez vous retarder l'extinction?"));
    QAbstractButton  *retarder = msgBox.addButton(tr("retarder l'extinction"), QMessageBox::ActionRole);

    msgBox.exec();
    msgBox.foregroundRole();

    if (msgBox.clickedButton() == retarder) {
        qDebug() << "retarder";
        timer->stop();
    }
}

void OS::askForSleep() {
    QTimer * timer = new QTimer(this);
    timer->setInterval(POP_UP_TIMER * 1000);
    timer->start();
    connect(timer, SIGNAL(timeout()), this, SLOT(timeOutSleepTimer()));

    QMessageBox msgBox;
    msgBox.setIcon(QMessageBox::Warning);
    msgBox.setText(tr("Votre ordinateur va se mettre en veille"));
    msgBox.setInformativeText(tr("Votre ordinateur va se mettre en veille, voulez vous retarder la mise en veille?"));
    QAbstractButton *retarder = msgBox.addButton(tr("retarder la mise en veille"), QMessageBox::ActionRole);
    msgBox.exec();




    if (msgBox.clickedButton() == retarder) {
        qDebug() << "retarder";
        timer->stop();
    }
}


void OS::timeOutShutdownTimer() {
    qDebug() << "timeOutShutdownTimer";
 	this->shutdown();
}

void OS::timeOutSleepTimer() {
    qDebug() << "timeOutSleepTimer";
    this->sleep();
}
