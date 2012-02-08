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

#include <QtGui/QApplication>
#include <QSettings>
#include <QDebug>
#include <QtGui>
#include <QMessageBox>
#include <QFile>
#include <QObject>
#include <QDomDocument>
#include <QTranslator>
#include "ecoparc.h"

static QString app_path;

void setAppPath(QString path) {
	app_path = path;
}

QString appPath() {
	return app_path;
}

QString qtTranslationPath() {
	return QLibraryInfo::location(QLibraryInfo::TranslationsPath);
}

QString translationPath() {
#ifdef TRANSLATION_PATH
	QString path = QString(TRANSLATION_PATH);
	if (!path.isEmpty())
		return path;
	else
		return appPath() + "/translations";
#else
	return appPath() + "/translations";
#endif
}

QString loadxml() {
    QFile file( "ecoparc_settings.xml" );

    if( !file.open( QIODevice::ReadOnly ) )
    {
        qDebug() << "Failed to load file. ecoparc_settings.xml" ;
        return  NULL;
    }

    QDomDocument doc( "settings" );
    if( !doc.setContent( &file ) )
    {
        qDebug() <<  "XML load file." ;
        file.close();
        return NULL;
    }

    file.close();

    QDomElement root = doc.documentElement();
    if( root.tagName() != "ecoparc-settings" )
    {
        qDebug() << "Invalid file." ;
        return NULL;
    }

    QDomElement racine = doc.documentElement();
    QDomNode noeud = racine.firstChild();
    QDomElement mesure;

    mesure = noeud.toElement();
    if (mesure.tagName() == "ip-server") {
        qDebug() << "ip-server";
        return mesure.text();
    }
    return NULL;
}

void loadSetting() {
    QSettings settings;
    QString ipServer;


    if (settings.value(QString("ip-server")).toString() == NULL && (ipServer = loadxml()) != NULL ) {
        qDebug() << "set ip-server" << ipServer;
        settings.setValue("ip-server", ipServer);
    }
}


void CheckStartup(bool startupEnabled){
    qDebug() << "startup check";
    QSettings settings("HKEY_CURRENT_USER\\Software\\Microsoft\\Windows\\CurrentVersion\\Run",QSettings::NativeFormat);
    if (startupEnabled) {

        settings.setValue("Ecoparc", QCoreApplication::applicationFilePath().replace('/','\\'));

    } else {
        settings.remove("Ecoparc");
    }
}

int main(int argc, char *argv[])
{

    QApplication a(argc, argv);
    a.setApplicationName("Ecoparc");
    a.setOrganizationName("Ecoparc");
    a.setOrganizationDomain("ecoparc.com");

    //QString trans_path = Paths::translationPath();
    QString locale = QLocale::system().name().section('_', 0, 0);
    QTranslator translator;

#if defined(Q_OS_LINUX)
    // QtService stores service settings in SystemScope, which normally require root privileges.
    // To allow testing this example as non-root, we change the directory of the SystemScope settings file.
    QSettings::setPath(QSettings::NativeFormat, QSettings::SystemScope, QDir::tempPath());
    qWarning("(Example uses dummy settings file: %s/QtSoftware.conf)", QDir::tempPath().toLatin1().constData());	
	QString path_mac = QString("/usr/share/locale/" + locale + "/LC_MESSAGES/ecoparc_"+locale+".qm");
    qDebug() << translator.load(path_mac);
    qDebug() << "linux";
#elif defined(Q_OS_WIN32)
    qDebug() << "win";
    CheckStartup(true);
    translator.load(QString("ecoparc_") + locale);
#else
   translator.load(QString("../Resources/translations/ecoparc_") + locale);
#endif
    a.installTranslator(&translator);	
    loadSetting();
    // if (!QSystemTrayIcon::isSystemTrayAvailable()) {
    //     QMessageBox::critical(0, QObject::tr("Systray"),
    //                           QObject::tr("I couldn't detect any system tray "
    //                                       "on this system."));
    //     return 1;
    // }
    QApplication::setQuitOnLastWindowClosed(false);
    Ecoparc w;
    w.resize(QSize(425, 350));
    w.setFixedSize(425, 350);
    return a.exec();
}
