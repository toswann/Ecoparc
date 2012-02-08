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

#ifndef XMLFORMAT_H
#define XMLFORMAT_H

#include <QObject>
#include <QXmlStreamWriter>
#include "sysinfo.h"
#include "ecoparc.h"

class xmlformat
{
    Q_ENUMS(MessageType)
public:
            xmlformat();
    QString messageType(Ecoparc::MessageType type);
};

#endif // XMLFORMAT_H
