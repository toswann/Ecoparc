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

#ifndef XMLPARSING_H
#define XMLPARSING_H

#include <QDomDocument>
#include <QObject>
#include "ecoparc.h"
#include <QDebug>
#include <QPointer>

class XMLParsing
{
    Q_ENUMS(MessageType)
public:
    XMLParsing(Ecoparc * callback);
    void parseMessage(QString * message);
private:
    QPointer <Ecoparc> _callback;
};

#endif // XMLPARSING_H
