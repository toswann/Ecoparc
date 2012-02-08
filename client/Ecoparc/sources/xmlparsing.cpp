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

#include "xmlparsing.h"

XMLParsing::XMLParsing(Ecoparc * callback)
{
    _callback = callback;
}


void XMLParsing::parseMessage(QString * message)
{
    bool isSucced = false,  auditMode = false;
    QDomDocument doc( "authMessage" );
    //qDebug () << "parse message =" + *message;
    if( !doc.setContent( *message ) )
    {
        qDebug() << "XMLParsing::parseMessage  doc.setContent fail";

        _callback->requestResult( Ecoparc::MessageError, false, NULL, 0, NULL);
        return ;
    }

    QString affichage;
    QDomNodeList tab;
    QDomElement mesure;
    QDomNode n;
    QString messageResult = NULL;
    Ecoparc::MessageType id_message;
    int timeNextRequest = 0;
    QDomElement racine = doc.documentElement(); // renvoie la balise racine
    QDomNode noeud = racine.firstChild(); // renvoie la premi√®re balise ¬´ mesure ¬ª
    messageResult = "parsing error";
    while(!noeud.isNull())
    {
        mesure = noeud.toElement();
        if (mesure.tagName() == EXECUTE_MSG_MESSAGE_ATTRIBUTE) {
            id_message = (Ecoparc::MessageType)mesure.text().toInt();
        }
        else if (mesure.tagName() == RESULT_BOOL_MESSAGE_ATTRIBUTE) {
            if (mesure.text() == "true")
                isSucced = true;
            else
                isSucced = false;
        }
        else if (mesure.tagName() == RESULT_DESCRIPTION_MESSAGE_ATTRIBUTE) {
            messageResult = mesure.text();
        }
        else if (mesure.tagName() == MODE_SERVER ) {
            if (mesure.text() == "true")
                auditMode = true;
            else
                auditMode = false;
        }
        else if (mesure.tagName() == TIME_NEXT_REQUEST_ATTRIBUTE) {
            timeNextRequest = mesure.text().toInt();
        }
        noeud = noeud.nextSibling(); // passe la "mesure" suivante
    }
    _callback->requestResult(id_message, isSucced, messageResult, timeNextRequest, auditMode);
}
