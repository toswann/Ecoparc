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

#include "xmlformat.h"

xmlformat::xmlformat()
{
}

QString xmlformat::messageType(Ecoparc::MessageType type) {
    qDebug() << "xmlformat:: type: " + QString::number(type);
    QString xmlMessage;
    QXmlStreamWriter xmlWriter(&xmlMessage);
    xmlWriter.setAutoFormatting(false);

    xmlWriter.writeStartElement("message");

    xmlWriter.writeStartElement(MAC_NODE_NAME);
    xmlWriter.writeCharacters( sysinfo().getMacAddress() );
    xmlWriter.writeEndElement();

    xmlWriter.writeStartElement(IP_NODE_NAME);
    xmlWriter.writeCharacters(sysinfo().getIpAddress() );
    xmlWriter.writeEndElement();

    xmlWriter.writeStartElement("messageID");
    if (type == Ecoparc::MessageAuthentification)
        xmlWriter.writeCharacters( "1" );
    else if (type == Ecoparc::MessageStatus)
        xmlWriter.writeCharacters( "2" );
    else if (type == Ecoparc::MessageReport)
        xmlWriter.writeCharacters( "3" );
    xmlWriter.writeEndElement();
    xmlWriter.writeEndDocument();

    return xmlMessage;
}

