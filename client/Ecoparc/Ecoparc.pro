#-------------------------------------------------
#
# Project created by QtCreator 2011-04-06T23:01:01
#
#-------------------------------------------------

QT       += core gui xml network

TARGET = ecoparc
TEMPLATE = app
DEPLOYMENT.display_name = Ecoparc client
VERSION = 0.9

SOURCES += \
    sources/main.cpp\
    sources/ecoparc.cpp \
    sources/os.cpp \
    sources/wmac.cpp \
    sources/wwindows.cpp \
    sources/wlinux.cpp \
    sources/sysinfo.cpp \
    sources/xmlformat.cpp \
    sources/xmlparsing.cpp \
    sources/infostore.cpp


HEADERS  += \
    sources/ecoparc.h \
    ecoparc_ui.h \
    sources/os.h \
    sources/wmac.h \
    sources/wwindows.h \
    sources/wlinux.h \
    sources/sysinfo.h \
    sources/xmlformat.h \
    sources/xmlparsing.h \
    sources/infostore.h


FORMS    += ressources/interface/ecoparc.ui

RESOURCES += \
    ressources/ressources.qrc

OTHER_FILES += \
    ecoparc_fr.qm \
    ecoparc_us.qm \
    ressources/images/logo.png \
    ressources/images/icon.png \
    licence.txt \
    ressources/images/icon.ico \
    ressources/images/feuille-ico.png \
    icon.ico


win32:RC_FILE += ressources/ecoparc-ico.rc

TRANSLATIONS += \
    ressources/languages/ecoparc_fr.ts \
    ressources/languages/ecoparc_en.ts

ICON = ressources/images/icon.icns
#
win32:ICON = "icon.ico"
#100 ICON "icon.ico"

QMAKE_MACOSX_DEPLOYMENT_TARGET = 10.5

#translationdir = /usr/share/ecoparc/translations
#export(translations.files)
#export(translations.path)

unix {
	DEFINES += TRANSLATION_PATH=$(TRANSLATION_PATH)
	DEFINES += SHORTCUTS_PATH=$(SHORTCUTS_PATH)
}

