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

#include "wwindows.h"
#include <QDebug>
#include <QProcess>
#include <QDialog>
#include <QSettings>
#include <QCoreApplication>

#include <iostream>
#include <iomanip>

using namespace std;

wwindows::wwindows()
{
  ;
}

void wwindows::askShutdown() {

    QProcess cmd;
    cmd.start("cmd.exe");

    cmd.write("%windir%\\System32\\shutdown.exe -s\n");
    cmd.closeWriteChannel();

    if (!cmd.waitForFinished())
        qDebug() << "waitForFinished";

    QByteArray result = cmd.readAll();
    qDebug() << result;
}

void wwindows::shutdown() {

    qDebug() << "Win shut";
    askShutdown();
}

void wwindows::makeSleep() {
    QProcess cmd;
    cmd.start("cmd.exe");

    cmd.write("%windir%\\System32\\rundll32.exe powrprof.dll,SetSuspendState Standby\n");
    cmd.closeWriteChannel();

    if (!cmd.waitForFinished())
        qDebug() << "waitForFinished";

    QByteArray result = cmd.readAll();
    qDebug() << result;
}

void wwindows::sleep() {

   qDebug() << "sleep Win:";
    wwindows::makeSleep();
}

void wwindows::initialize() {
    QSettings settings("HKEY_CURRENT_USER\\Software\\Microsoft\\Windows\\CurrentVersion\\Run",QSettings::NativeFormat);
    //if (startupEnabled) {
        settings.setValue("Ecoparc", QCoreApplication::applicationFilePath().replace('/','\\'));
    //} else {
      //  settings.remove("Ecoparc");
    //}
}

